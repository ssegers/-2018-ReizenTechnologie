<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use App\Traveller;
use App\Trip;
use App\User;
use App\Zip;
use App\TravellersPerTrip;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Tag\Tr;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class UserDataController extends Controller
{
    /* List of all filters */
    protected $aFilterList = [
        'username'=>'Gebruikersnaam',
        'study_name'=>'Richting',
        'major_name'=>'Afstudeerrichting',
        'birthdate' => 'Geboortedatum',
        'birthplace' => 'Geboorteplaats',
        'gender' => 'Geslacht',
        'nationality' => 'Nationaliteit',
        'address' => 'Adres',
        'zip_code'=>'Postcode',
        'city'=>'Stad',
        'country' => 'Land',
        'email' => 'Email',
        'phone' => 'Telefoon',
        'emergency_phone_1' => 'Nood Contact 1',
        'emergency_phone_2' => 'Nood Contact 2',
        'medical_info' => 'Medische Info',
    ];

    /* List of standard filters */
    protected $aFiltersChecked = array(
        'last_name' => 'Familienaam',
        'first_name' => 'Voornaam',
    );

    /**
     * Generates a list of travellers based on the applied filters, current authenticated user and selected trip.
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     * @param $sUserName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showUsersAsMentor(Request $request, $iTripId = null) {
        $oUser = Auth::user();

        /* Get all active trips */
        $aActiveTrips = Trip::where('is_active', true)->get();

        /* Get all trips that can be accessed by the user */
        if ($oUser->role == 'admin') {
            $aOrganizerTrips = $aActiveTrips;
        } else if ($oUser->role == 'guide') {
            $aOrganizerTrips = User::where('users.user_id', $oUser->user_id)->where('is_active', true)->where('is_organizer', true)
                ->join('travellers', 'travellers.user_id', '=', 'users.user_id')
                ->join('travellers_per_trips', 'travellers_per_trips.traveller_id', '=', 'travellers.traveller_id')
                ->join('trips', 'trips.trip_id', '=', 'travellers_per_trips.trip_id')
                ->get();
        }

        /* Check if user can access the trip */
        if ($iTripId != null) {
            $bCanAccess = false;
            foreach ($aOrganizerTrips as $oTrip) {
                if ($iTripId == $oTrip->trip_id) {
                    $bCanAccess = true;
                }
            }
            if ($bCanAccess == false) {
                return 'U heeft geen rechten om deze lijst te bekijken';
            }
        } else {
            $iTripId = $aOrganizerTrips[0]->trip_id;
            $bCanAccess = true;
        }

        $oCurrentTrip = Trip::where('trip_id', $iTripId)->first();

        /* Detect the applied filters and add to the list of standard filters */
        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($request->post($sFilterName) != false) {
                $this->aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }
        $aFiltersChecked = $this->aFiltersChecked;

        $aActiveTrips = array();
        foreach (Trip::where('is_active', true)->get() as $oTrip) {
            array_push($aActiveTrips, array(
                'oTrip' => $oTrip,
                'iCount' => TravellersPerTrip::where('trip_id', $oTrip->trip_id)
                    ->get()
                    ->count(),
            ));
        }

        foreach ($aOrganizerTrips as $oTrip) {
            $aAuthenticatedTrips[$oTrip->trip_id] = $oTrip->trip_id;
        }

        /* Save th active pagination */
        $aPaginate = array(
            '5' => false,
            '10' => false,
            '15' => false,
            '20' => false,
            '25' => false,
        );
        if ($iPaginate = $request->post('per-page')) {
            $aPaginate[$iPaginate] = true;
        }
        else {
            $aPaginate[$iPaginate = 15] = true;
        }

        /* Get the travellers based on the applied filters */
        $aUserData = Traveller::getTravellersDataByTrip($iTripId, $aFiltersChecked, $iPaginate);

        /* Check witch download option is checked */
        switch ($request->post('export')) {
            case 'excel':
                $this->downloadExcel($aFiltersChecked, $oCurrentTrip);
                break;
            case 'pdf':
                $this->downloadPDF($aFiltersChecked, $oCurrentTrip);
                break;
        }

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFilterList' => $this->aFilterList,
            'aFiltersChecked' => $aFiltersChecked,
            'sUserName' => $oUser->username,
            'oCurrentTrip' => $oCurrentTrip,
            'aActiveTrips' => $aActiveTrips,
            'aPaginate' => $aPaginate,
            'aAuthenticatedTripId' => $aAuthenticatedTrips,
        ]);
    }


    /**
     * @author Sasha Van de Voorde
     * @param $aFiltersChecked
     * @param $iTrip
     * @return \Exception|Exception
     * This will download an excel file based on the session data of filters (the checked fields)
     */
    private function downloadExcel($aFiltersChecked, $iTrip) {
        $aUserFields = $aFiltersChecked;
        $data = Traveller::getTravellersDataByTrip($iTrip->trip_id, $aFiltersChecked);
//        $data = $this->getUserData($aFiltersChecked, $iTrip);
        try {
            /** Create a new Spreadsheet Object **/
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($aUserFields, '', 'A1');
            $sheet->fromArray($data, '', 'A2');
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="travellers.xlsx"');
            $writer->save("php://output");
            exit;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * downloadPDF: deze functie zorgt ervoor dat je een pdf van de gefilterde lijst download.
     */
    private function downloadPDF($aFiltersChecked, $iTrip){
        $iCols = count($aUserFields = $aFiltersChecked);
        $aAlphas = range('A', 'Z');
        $oTrip = Trip::where('trip_id', $iTrip->trip_id)->first();

        $data = Traveller::getTravellersDataByTrip($iTrip->trip_id, $aFiltersChecked);
        try {
            $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
            $spreadsheet->getActiveSheet();
            $activeSheet = $spreadsheet->getActiveSheet();
            if($iCols>8){
                $activeSheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            }
            $activeSheet->fromArray($aUserFields,NULL, 'A1')->getStyle('A1:'.$aAlphas[$iCols-1].'1')->getFont()->setBold(true)->setUnderline(true);
            $activeSheet->getStyle('A1:'.$aAlphas[$iCols-1]."1")->getBorders()->getOutline()->setBorderStyle(1);
            $activeSheet->fromArray($data,NULL,'A2');
            foreach ($data as $iRij=>$sValue){
                //$activeSheet->getStyle('A'.($iRij+2).':'.$aAlphas[$iCols-1].($iRij+2))->getBorders()->getOutline()->setBorderStyle(1);
                for($iI = 0;$iI<$iCols;$iI++){
                    $activeSheet->getStyle('A'.($iRij+2).':'.$aAlphas[$iI].($iRij+2))->getBorders()->getOutline()->setBorderStyle(1);
                }
            }

            IOFactory::registerWriter("PDF", Mpdf::class);
            $writer = IOFactory::createWriter($spreadsheet, 'PDF');

            header('Content-Disposition: attachment; filename="'.$oTrip->name.'_gefilterde_lijst.pdf"');
            $writer->save("php://output");
        } catch (Exception $e) {
        }

    }

    /**
     * Returns the filtered users based on the applied filters and selected trip. The users will be paginated if an amount is specified.
     *
     * @author Yoeri op't Roodt
     *
     * @param $aFilters
     * @param $oTrip
     * @param bool $iPaginate
     *
     * @return mixed
     */
    private function getUserData($aFilters, $oTrip, $iPaginate = false) {
        $aTravellerIds = TravellersPerTrip::select('traveller_id')->where('trip_id', $oTrip->trip_id)->get();
        if ($iPaginate) {
            /* For click event: Add name to selection */
            return Traveller::select(array_keys(array_add($aFilters, 'username', true)))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->whereIn('traveller_id', $aTravellerIds)
                ->paginate($iPaginate);


        }
        return Traveller::select(array_keys($aFilters))
            ->join('users','travellers.user_id','=','users.user_id')
            ->join('zips','travellers.zip_id','=','zips.zip_id')
            ->join('majors','travellers.major_id','=','majors.major_id')
            ->join('studies','majors.study_id','=','studies.study_id')
            ->whereIn('traveller_id', $aTravellerIds)
            ->get()->toArray();
    }

    /**
     * Shows the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param Request $request
     * @param $sUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showUserData(Request $request, $sUserName = 'undefined')
    {
        //als het naar /profile is
        if($sUserName == 'undefined'){
            if (Auth::user()->role == "admin"){
                return redirect(route("info"));
            }

            $sUserName = Auth::user()->username;
        }
        //als het naar /userdata/{username} is
        else{
            /*  Beveiliging - Begeleider mag enkel de profielen van zijn reizigers bekijken  */
            $iTripIdTraveller = TravellersPerTrip::select('trip_id')
                ->join('travellers', 'travellers_per_trips.traveller_id', '=', 'travellers.traveller_id')
                ->join('users', 'travellers.user_id', '=', 'users.user_id')
                ->where('username', $sUserName)
                ->first();
            $aTripIdsGuide = TravellersPerTrip::select('trip_id')
                ->join('travellers', 'travellers_per_trips.traveller_id', '=', 'travellers.traveller_id')
                ->join('users', 'travellers.user_id', '=', 'users.user_id')
                ->where('username', Auth::user()->username)
                ->get();

            $bIsGuideOfTraveller = false;
            foreach($aTripIdsGuide as $aTripIdGuide){
                if($iTripIdTraveller != $aTripIdGuide){
                    $bIsGuideOfTraveller = true;
                }
            }
            if(!$bIsGuideOfTraveller){
                return redirect(route("info"));
            }
            /*  */
        }

        $sUserRole = User::where('username', $sUserName)->select('role')->first();
        if($sUserRole["role"] == 'guide'){
            $aUserData = User::select()
                ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
                ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
                ->join('travellers_per_trips', 'travellers.traveller_id', '=', 'travellers_per_trips.traveller_id')
                ->join('trips', 'travellers_per_trips.trip_id', '=', 'trips.trip_id')
                ->join('majors', 'travellers.major_id', '=', 'majors.major_id')
                ->join('studies', 'majors.study_id', '=', 'studies.study_id')
                ->where('users.username', '=', $sUserName) //r-nummer
                ->where('is_guide', true)
                ->first();
        }
        else{
            $aUserData = User::select()
                ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
                ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
                ->join('travellers_per_trips', 'travellers.traveller_id', '=', 'travellers_per_trips.traveller_id')
                ->join('trips', 'travellers_per_trips.trip_id', '=', 'trips.trip_id')
                ->join('majors', 'travellers.major_id', '=', 'majors.major_id')
                ->join('studies', 'majors.study_id', '=', 'studies.study_id')
                ->where('users.username', '=', $sUserName) //r-nummer
                ->first();
        }

        //var_dump($request);

        if(str_contains($request->path(), 'edit')){
            $oTrips = Trip::select()->where('is_active', '=', true)->get();
            $oZips = Zip::all();
            $oStudies = Study::all();
            $oMajors = Major::where("study_id", $aUserData->study_id)->get();

            return view('user.profile.profileEdit', ['sPath' => $request->path(),'aUserData' => $aUserData, 'oTrips' => $oTrips, 'oZips' => $oZips, 'oStudies' => $oStudies, 'oMajors' => $oMajors]);
        }
        return view('user.profile.profile', ['sPath' => $request->path(),'aUserData' => $aUserData]);
    }

    /**
     * Updates the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param Request $aRequest
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserData(Request $aRequest, $sUserName)
    {
        if (Auth::user()->role == "admin"){
            return redirect(route("info"));
        }
        
        $aRequest->validate([
            'LastName'      => 'required',
            'FirstName'     => 'required',
            'IBAN'          => 'required|iban',
            'BIC'           => 'required|bic',

            'BirthDate'     => 'required',
            'Birthplace'    => 'required',
            'Nationality'   => 'required',
            'Address'       => 'required',
            'Country'       => 'required',

            'Phone'         => 'required|phone:BE,NL',
            'icePhone1'     => 'required|phone:BE,NL',
            'icePhone2'     => 'nullable|phone:BE,NL'
        ],$this->messages());
        $oUser = User::where('users.username', $sUserName)->first();
        $oUser::where('users.username', '=', $sUserName) //r-nummer
            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
            ->update(
                [
                    'last_name'         => $aRequest->post('LastName'),
                    'first_name'        => $aRequest->post('FirstName'),
                    'gender'            => $aRequest->post('Gender'),
                    'major_id'          => $aRequest->post('Major'),
                    'iban'              => $aRequest->post('IBAN'),
                    'bic'               => $aRequest->post('BIC'),
                    'medical_issue'     => $aRequest->post('MedicalIssue'),
                    'medical_info'      => $aRequest->post('MedicalInfo'),

                    'birthdate'         => $aRequest->post('BirthDate'),
                    'birthplace'        => $aRequest->post('Birthplace'),
                    'nationality'       => $aRequest->post('Nationality'),
                    'address'           => $aRequest->post('Address'),
                    'zip_id'            => $aRequest->post('City'),
                    'country'           => $aRequest->post('Country'),
                    'phone'             => $aRequest->post('Phone'),
                    'emergency_phone_1' => $aRequest->post('icePhone1'),
                    'emergency_phone_2' => $aRequest->post('icePhone2'),
                ]
            );


        /* travellers_per_trips table */
        if($oUser->role == "traveller"){
            TravellersPerTrip::where('traveller_id', $oUser->traveller->traveller_id)->update(['trip_id' => $aRequest->post('Trip')]);
        }
        else if ($oUser->role == "guide"){
            $aTripsGuide = TravellersPerTrip::select('is_organizer')
                ->join('travellers', 'travellers_per_trips.traveller_id', '=', 'travellers.traveller_id')
                ->join('users', 'travellers.user_id', '=', 'users.user_id')
                ->where('username', $oUser->username)
                ->get();
            $bIsGuideAnOrganiser = false;
            foreach($aTripsGuide as $aTripGuide){
                if($aTripGuide->is_orangiser == true){
                    $bIsGuideAnOrganiser = true;
                }
            }
            if(!$bIsGuideAnOrganiser){
                TravellersPerTrip::where('traveller_id', $oUser->traveller->traveller_id)
                    ->where('is_guide', true)
                    ->update(['is_guide' => false]);

                if(TravellersPerTrip::where('trip_id', $aRequest->post('Trip'))->where('traveller_id', $oUser->traveller->traveller_id)->exists()){
                    TravellersPerTrip::where('trip_id', $aRequest->post('Trip'))
                        ->where('traveller_id', $oUser->traveller->traveller_id)
                        ->update([
                            'is_guide' => true,
                        ]);
                }
                else{
                    TravellersPerTrip::where('trip_id', $aRequest->post('Trip'))
                        ->where('traveller_id', $oUser->traveller->traveller_id)
                        ->insert([
                            'trip_id' => $aRequest->post('Trip'),
                            'traveller_id' => $oUser->traveller->traveller_id,
                            'is_guide' => true,
                            'is_organizer' => false
                        ]);
                }
            }
            /* Update travellers_per_trips table for guides who are organisers */
            else{
                TravellersPerTrip::where('traveller_id', $oUser->traveller->traveller_id)->update(['trip_id' => $aRequest->post('Trip')]);
            }
        }

        if(str_contains($aRequest->path(), 'profile')){
            return redirect('profile');
        }
        return redirect('userinfo/'. $sUserName);
    }

    /**
     * Deletes the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function deleteUserData($sUserName){
        $User = User::where('username', $sUserName)->firstOrFail();
        $User->delete();
        return redirect(route("info"))->with('success', 'Je hebt je succesvol het account van '.$sUserName.' verwijdert.');
    }

    /**
     * Error messages
     *
     * @author Joren Meynen
     * @return array
     */
    public function messages()
    {
        return [
            'LastName.required'     => 'U heeft geen achternaam ingevuld.',
            'FirstName.required'    => 'U heeft geen voornaam ingevuld.',
            'IBAN.required'         => 'U heeft geen IBAN-nummer ingevuld.',
            'iban'                  => 'U heeft geen geldig IBAN-nummer ingevuld.',
            'bic'                   => 'U heeft geen geldig BIC-nummer ingevuld.',
            'BirthDate.required'    => 'U heeft geen geboortedatum ingevuld.',
            'Birthplace.required'   => 'U heeft geen geboorteplaats ingevuld.',
            'Nationality.required'  => 'U heeft geen nationaliteit ingevuld.',
            'Address.required'      => 'U heeft geen adres ingevuld.',
            'Country.required'      => 'U heeft geen land ingevuld.',

            'Phone.required'        => 'U heeft geen GSM-nummer ingevuld.',
            'Phone.phone'           => 'U heeft geen geldig GSM-nummer ingevuld.',
            'icePhone1.required'    => 'U heeft bij \'noodnummer 1\' niets ingevuld.',
            'icePhone1.phone'       => 'U heeft bij \'noodnummer 1\' geen geldig nummer ingevuld.',
            'icePhone2.phone'       => 'U heeft bij \'noodnummer 2\' geen geldig nummer ingevuld.',
        ];
    }

    /**
     * Cascading dropdown
     *
     * @author Joren Meynen
     * @param Request $request
     */
    public function GetMajorsByStudy(Request $request){
        $study = $request->get('study');
        $majors = Major::select()
            ->where("study_id", $study)
            ->get();

        $output = '<option value="">Selecteer een afstudeerrichting</option>';
        foreach($majors as $major){
            $output .= '<option value="'.$major->major_id.'">'.$major->major_name.'</option>';
        }

        echo $output;
    }
}

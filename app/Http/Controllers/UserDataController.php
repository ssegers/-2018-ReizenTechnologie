<?php

namespace App\Http\Controllers;

use App\Major;
use App\Study;
use App\Traveller;
use App\Trip;
use App\User;
use App\Zip;
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
    public function showUsersAsMentor(Request $request, $sUserName) {
        /* Get user from Auth */
        $oUser = Auth::user();

        /* Get user from URL */
        //$oUser = User::where('username', $sUserName)->first();

        /* Check if user exist and is a organizer */
        try {
            if ($oUser->role != 'organizer') {
                return 'Deze gebruiker is niet gemachtigd';
            }
        }
        catch (\Exception $exception) {
            return 'Deze gebruiker bestaat niet';
        }

        /* Detect the applied filters and add to the list of standard filters */
        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($request->post($sFilterName) != false) {
                $this->aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }
        $aFiltersChecked = $this->aFiltersChecked;

        /* Get the trip where the organizer is involved with */
        $aOrganizerTrip = Trip::where('user_id', $oUser->user_id)->where('is_active', true)
            ->join('travellers', 'trips.trip_id', '=', 'travellers.trip_id')
            ->first();

        /* Get all active trips */
        $aActiveTrips = array();
        foreach (Trip::where('is_active', true)->get() as $oTrip) {
            array_push($aActiveTrips, array(
                'oTrip' => $oTrip,
                'iCount' => Traveller::where('trip_id', $oTrip->trip_id)
                    ->get()
                    ->count(),
            ));
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
        $aUserData = $this->getUserData($aFiltersChecked, $aOrganizerTrip, $iPaginate);

        /* Check witch download option is checked */
        switch ($request->post('export')) {
            case 'excel':
                $this->downloadExcel($aFiltersChecked, $aOrganizerTrip);
                break;
            case 'pdf':
                $this->downloadPDF($aFiltersChecked, $aOrganizerTrip);
                break;
        }

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFilterList' => $this->aFilterList,
            'aFiltersChecked' => $aFiltersChecked,
            'sUserName' => $oUser->username,
            'oCurrentTrip' => $aOrganizerTrip,
            'aActiveTrips' => $aActiveTrips,
            'aPaginate' => $aPaginate,
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
        $data = $this->getUserData($aFiltersChecked, $iTrip);
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

        $data = $this->getUserData($aFiltersChecked, $iTrip);
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
     * @param $iTrip
     * @param bool $iPaginate
     *
     * @return mixed
     */
    private function getUserData($aFilters, $iTrip, $iPaginate = false) {
        if ($iPaginate) {
            /* For click event: Add name to selection */
            return Traveller::select(array_keys(array_add($aFilters, 'username', true)))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTrip->trip_id)->paginate($iPaginate);
        }
        return Traveller::select(array_keys($aFilters))
            ->join('users','travellers.user_id','=','users.user_id')
            ->join('zips','travellers.zip_id','=','zips.zip_id')
            ->join('majors','travellers.major_id','=','majors.major_id')
            ->join('studies','majors.study_id','=','studies.study_id')
            ->where('trip_id', $iTrip->trip_id)->get()->toArray();
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
    public function showUserData(Request $request, $sUserName)
    {
        /* Get user from Auth */
        $oUser = Auth::user();
        $sSegers = 'u0598673';
        $sRoox = 'u0569802';
        /* Get user from URL */
        $oUser = User::where('username', $sSegers)->first();
        try {
            if ($oUser->role != 'organizer') {
                return 'Deze gebruiker is niet gemachtigd';
            }
        }
        catch (\Exception $exception) {
            return 'Deze gebruiker bestaat niet';
        }



        $aUserData = User::select()
            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
            ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
            ->join('trips', 'travellers.trip_id', '=', 'trips.trip_id')
            ->join('majors', 'travellers.major_id', '=', 'majors.major_id')
            ->join('studies', 'majors.study_id', '=', 'studies.study_id')
            ->where('users.username', '=', $sUserName) //r-nummer
            ->first();


        if(str_contains($request->path(), 'edit')){
            $oTrips = Trip::select()->where('is_active', '=', true)->get();
            $oZips = Zip::all();
            $oStudies = Study::all();
            $oMajors = Major::where("study_id", $aUserData->study_id)->get();
            return view('user.filter.individualTravellerEdit', ['aUserData' => $aUserData, 'oTrips' => $oTrips, 'oZips' => $oZips, 'oStudies' => $oStudies, 'oMajors' => $oMajors]);
        }
        return view('user.filter.individualTraveller', ['aUserData' => $aUserData, 'sName' => $oUser->username]);
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
        $aRequest->validate([
            'LastName'      => 'required',
            'FirstName'     => 'required',
            'IBAN'          => 'required|iban',

            'BirthDate'     => 'required',
            'Birthplace'    => 'required',
            'Nationality'   => 'required',
            'Address'       => 'required',
            'Country'       => 'required',

            'Phone'         => 'required|phone:BE',
            'icePhone1'     => 'required|phone:BE',
            'icePhone2'     => 'nullable|phone:BE'
        ],$this->messages());

        User::where('users.username', '=', $sUserName) //r-nummer
            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
            ->update(
                [
                    'last_name'         => $aRequest->post('LastName'),
                    'first_name'        => $aRequest->post('FirstName'),
                    'gender'            => $aRequest->post('Gender'),
                    'major_id'          => $aRequest->post('Major'),
                    'trip_id'           => $aRequest->post('Trip'),
                    'iban'              => $aRequest->post('IBAN'),
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
        return redirect('/info')->with('message', 'Je hebt je succesvol het account van '.$sUserName.' verwijdert.');
    }

    /**
     * @author Joren Meynen
     *
     * @return array
     */
    public function messages()
    {
        return [
            'LastName.required'     => 'U heeft geen achternaam ingevuld.',
            'FirstName.required'    => 'U heeft geen voornaam ingevuld.',
            'IBAN.required'         => 'U heeft geen IBAN-nummer ingevuld.',
            'iban'                  => 'U heeft geen geldig IBAN-nummer ingevuld.',
            'BirthDate.required'    => 'U heeft geen geboortedatum ingevuld.',
            'Birthplace.required'   => 'U heeft geen geboorteplaats ingevuld.',
            'Nationality.required'  => 'U heeft geen nationaliteit ingevuld.',
            'Address.required'      => 'U heeft geen adres ingevuld.',
            'Country.required'      => 'U heeft geen land ingevuld.',

            'Phone.required'        => 'U heeft geen GSM-nummer ingevuld.',
            'Phone.phone'        => 'U heeft geen geldig GSM-nummer ingevuld.',
            'icePhone1.required'    => 'U heeft bij \'noodnummer 1\' niets ingevuld.',
            'icePhone1.phone'    => 'U heeft bij \'noodnummer 1\' geen geldig nummer ingevuld.',
            'icePhone2.phone'    => 'U heeft bij \'noodnummer 2\' geen geldig nummer ingevuld.',
        ];
    }

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

<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        'name'=>'Gebruikersnaam',
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
        $oUser = User::where('name', $sUserName)->first();

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
            'sUserName' => $oUser->name,
            'oCurrentTrip' => $aOrganizerTrip,
            'aActiveTrips' => $aActiveTrips,
            'aPaginate' => $aPaginate,
        ]);
    }

    /**
     * downloadExcel : this will download an excel file based on the session data of filters (the checked fields)
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
            return Traveller::select(array_keys(array_add($aFilters, 'name', true)))
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
     * @param $sUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showUserData($sUserName)
    {
        /* Get user from Auth */
        $oUser = Auth::user();

        $sSegers = 'u0598673';
        $sRoox = 'u0569802';

        /* Get user from URL */
        $oUser = User::where('name', $sSegers)->first();
        try {
            if ($oUser->role != 'organizer') {
                return 'Deze gebruiker is niet gemachtigd';
            }
        }
        catch (\Exception $exception) {
            return 'Deze gebruiker bestaat niet';
        }

//        $first = User::select()
//            ->join('travellers', 'users.user_id', '=', 'travellers.user_id')
//            ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
//            ->join('trips', 'travellers.trip_id', '=', 'trips.trip_id')
//            ->where('users.name', '=', $sUserName) //r-nummer
//            ->toSql();
//        dd($first);

        $oUserData = DB::select("
                            SELECT
                              users.*,
                              travellers.*,
                              trips.*,
                              zips.*,
                              users.name as user_name,
                              trips.name as trip_name
                            FROM users
                            INNER JOIN travellers ON users.user_id = travellers.user_id
                            INNER JOIN trips      ON travellers.trip_id = trips.trip_id
                            INNER JOIN zips       ON travellers.zip_id = zips.zip_id
                            WHERE users.name = :sUserName", ['sUserName' => $sUserName]);

        $aUserData = json_decode(json_encode($oUserData), true);


        var_dump($aUserData);

        //return view('user.filter.individualTraveller', ['aUserData' => $aUserData]);
    }
}

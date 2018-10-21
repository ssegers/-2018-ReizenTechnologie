<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class UserDataController extends Controller
{
    /* List of all filters */
    protected $aFilterList = [
        'name'=>'r-Nummer',
        'study_name'=>'Richting',
        'major_name'=>'Afstudeerrichting',
        'birthdate' => 'Geboortedatum',
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
        $iTrip = Traveller::select('trip_id')->where('user_id', $oUser->user_id)->first();

        /* Get the travellers based on the applied filters */
        $aUserData = $this->getUserData($aFiltersChecked, $iTrip, 15);

        /* Check witch download option is checked */
        switch ($request->post('export')) {
            case 'excel':
                $this->downloadExcel($aFiltersChecked, $iTrip);
                break;
            case 'pdf':
                $this->downloadPDF($aFiltersChecked, $iTrip);
                break;
        }

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFilterList' => $this->aFilterList,
            'aFiltersChecked' => $aFiltersChecked,
            'sUserName' => $oUser->name,
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
        $oTrip = (string) Trip::select('name')->where('trip_id', $iTrip->trip_id)->first();
        $sTripNaam =str_before(str_after($oTrip,":"),"}");

        $data = $this->getUserData($aFiltersChecked, $iTrip);

        try {
            $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
            $spreadsheet->getActiveSheet();
            $activeSheet = $spreadsheet->getActiveSheet();
            if($iCols>8){
                $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            }
            $spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.2);
            $spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.5);
            $activeSheet->fromArray($aUserFields,NULL, 'A1')->getStyle('A1:'.$aAlphas[$iCols-1].'1')->getFont()->setBold(true)->setUnderline(true);
            $activeSheet->fromArray($data,NULL,'A2');

            IOFactory::registerWriter("PDF", Dompdf::class);
            $writer = IOFactory::createWriter($spreadsheet, 'PDF');

            header('Content-Disposition: attachment; filename="'.$sTripNaam.'gefilterde_lijst.pdf"');
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
            return Traveller::select(array_keys($aFilters))
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
     * Shows the form of a selected traveller
     * Find all details of selected traveller
     * Show the view
     *
     * @author Joren Meynen
     *
     * @param $user_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editTraveller($user_id)
    {
        $aTraveller = Traveller::select()
            ->join('users', 'travellers.user_id', '=', 'users.user_id')
            ->join('zips', 'travellers.zip_id', '=', 'zips.zip_id')
            ->where('travellers.user_id', '=', $user_id)
            ->first();

       return view('user.filter.individualTraveller', ['traveller' => $aTraveller]);
    }
}

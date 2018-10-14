<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class UserDataController extends Controller
{
    /* List of all filters */
    protected $aFilterList = [
        'email' => 'Email',
        'country' => 'Land',
        'address' => 'Adres',
        'gender' => 'Geslacht',
        'phone' => 'Telefoon',
        'emergency_phone_1' => 'Nood Contact 1',
        'emergency_phone_2' => 'Nood Contact 2',
        'nationality' => 'Nationaliteit',
        'birthdate' => 'Geboortedatum',
        'medical_info' => 'Medische Info',
    ];
    /* Temp request save */
    private $request;

    /**
     * Generates a list of travellers based on the applied filters, current authenticated user and selected trip
     *
     * @author Yoeri op't Roodt
     * @param Request $request
     * @param $sUserName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showUsersAsMentor(Request $request, $sUserName)
    {
        $this->request = $request;

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

        /* Get  list of checked filters */
        $aFiltersChecked = $this->getCheckedFilters();

        /* Get the trip where the organizer is involved with */
        $iTrip = Traveller::select('trip_id')->where('user_id', $oUser->user_id)->first();

        /* Get the travellers based on the applied filters */
        $aUserData = Traveller::select(array_keys($aFiltersChecked))->where('trip_id', $iTrip->trip_id)->paginate(15);

        /* Check witch download option is checked */
        switch ($request->post('export')) {
            case 'excel':
                $this->downloadExcel();
                break;
            case 'pdf':
                $this->downloadPDF();
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
    private function downloadExcel() {
        $aUserFields = $this->getCheckedFilters();

        $data = Traveller::select(array_keys($aUserFields))->get()->toArray();

        return Excel::create('Gebruikers', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    /**
     * downloadPDF: deze functie zorgt ervoor dat je een pdf van de gefilterde lijst download.
     */
    private function downloadPDF(){
        $aUserFields = $this->getCheckedFilters();
        $iCols = count($aUserFields);
        $aAlphas = range('A', 'Z');
        $data = Traveller::select(array_keys($aUserFields))->get()->toArray();

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

            header('Content-Disposition: attachment; filename="gefilterte_tabel.pdf"');


            $writer->save("php://output");
        } catch (Exception $e) {
        }

    }

    /**
     * Returns array of fields based on the current selected filters
     *
     * @author Yoeri op't Roodt
     *
     * @return array
     */
    private function getCheckedFilters() {
        /* Set the standard filters */
        $aFiltersChecked = array(
            'last_name' => 'Familienaam',
            'first_name' => 'Voornaam'
        );

        /* Detect the applied filters and add to the list of standard filters */
        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($this->request->post($sFilterName) != false) {
                $aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }

        return $aFiltersChecked;
    }
}

<?php

namespace App\Http\Controllers;


use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class UserDataController extends Controller
{
    protected $aFilterList = [
        'email' => 'Email',
        'phone' => 'Telefoon',
    ];
    private $request;

    public function showUsersAsMentor(Request $request)
    {
        $this->request = $request;
        $id = Auth::id();

        $aFiltersChecked = $this->getCheckedFilters();

        if ($request->post('button-filter')) {
            $aUserData = Traveller::select(array_keys($aFiltersChecked))->paginate(2);
        }
        else {
            $aUserData = Traveller::select(DB::raw('lastname,firstname,phone'))->paginate(2);;
        }

        if ($request->post('export') == 'exel') {
            $this->downloadExcel();
        }

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFilterList' => $this->aFilterList,
            'aFiltersChecked' => $aFiltersChecked
        ]);
    }

    /**
     * downloadExcel : this will download an excel file based on the session data of filters (the checked fields)
     */
    private function downloadExcel() {
        $aUserFields = $this->getCheckedFilters();
        $data = Traveller::select(array_keys($aUserFields))->get()->toArray();
        /** Create a new Spreadsheet Object **/
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($aUserFields, NULL, 'A1');
        $sheet->fromArray($data, NULL, 'A2');
        $writer = new Xlsx($spreadsheet);
        $writer->save('travellers.xlsx');

        $sName = 'travellers.xlsx';
        $file= public_path() . '/'. $sName;
        $response = response()->download($file);
        echo $response;
        /*  $fileContents = Storage::disk('local')->get($file);
          echo $fileContents;*/
        /*    $fileContents = Storage::disk('local')->get($file);
             $response = Response::make($fileContents, 200);
             $response->header('Content-Type', Storage::disk('local')->mimeType($file));
             return $response;*/
       // return Storage::download($fileContents);

    }

    /**
     * Returns array of fields based on the current selected filters
     *
     * @author Yoeri op't Roodt
     * @return array
     */
    private function getCheckedFilters() {
        $aFiltersChecked = array(
            'lastname' => 'Familienaam',
            'firstname' => 'Voornaam'
        );

        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($this->request->post($sFilterName) != false) {
                $aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }

        return $aFiltersChecked;
    }
}

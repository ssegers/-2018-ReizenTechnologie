<?php

namespace App\Http\Controllers;

use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserDataController extends Controller
{
    protected $aFilterList = [
        'email' => 'Email',
        'phone' => 'Telefoon',
        'country'=>'Land',
        'address'=>'Adres',
        'gender'=>'Geslacht',
        'emergency_phone_1'=>'Noodnummer1',
        'emergency_phone_2'=>'Noodnummer2',
        'nationality'=>'Nationaliteit',
        'birthdate'=>'Geboortedatum',
        'birthplace'=>'Geboorteplaats',
        'medical_issue'=>'Medisch probleem',
        'medical_info'=>'Medische info'

    ];
    private $request;

    public function showUsersAsMentor(Request $request)
    {
        $this->request = $request;
        $id = Auth::id();

        $aFiltersChecked = $this->getCheckedFilters();

        if ($request->post('button-filter')) {
            $aUserData = Traveller::select(array_keys($aFiltersChecked))->paginate(5);
        }
        else {
            $aUserData = Traveller::select(array_keys($aFiltersChecked))->paginate(5);;
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

        return Excel::create('Gebruikers', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    /**
     * Returns array of fields based on the current selected filters
     *
     * @author Yoeri op't Roodt
     * @return array
     */
    private function getCheckedFilters() {
        $aFiltersChecked = array(
            'last_name' => 'Familienaam',
            'first_name' => 'Voornaam'
        );

        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($this->request->post($sFilterName) != false) {
                $aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }

        return $aFiltersChecked;
    }
}

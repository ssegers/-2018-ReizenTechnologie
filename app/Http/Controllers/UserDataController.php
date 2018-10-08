<?php

namespace App\Http\Controllers;

use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserDataController extends Controller
{
    public function showUsersAsMentor(Request $request)
    {
        $id = Auth::id();

        $aFiltersChecked = array(
            'lastname' => 'Familienaam',
            'firstname' => 'Voornaam'
        );

        $aFilterList = array(
            'email' => 'Email',
            'phone' => 'Telefoon',
        );

        foreach ($aFilterList as $sFilterName => $sFilterText) {
            if ($request->post($sFilterName) != false) {
                $aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }

        if ($request->post('button-filter')) {
            $aUserData = Traveller::select(array_keys($aFiltersChecked))->paginate(2);
        }
        else {
            $aUserData = Traveller::select(DB::raw('lastname,firstname,phone'))->paginate(2);;
        }

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
            'aFilterList' => $aFilterList,
            'aFiltersChecked' => $aFiltersChecked
        ]);
    }

    /**
     * downloadExcel : this will download an excel file based on the session data of filters (the checked fields)
     */
    public function downloadExcel(Request $request)
    {
        $aUserFields = $request->session()->get('filters');
        $data = UserData::get($aUserFields)->toArray();

        return Excel::create('Gebruikers', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
}

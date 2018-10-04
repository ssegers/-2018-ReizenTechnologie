<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserDataController extends Controller
{
    public function showUsersAsMentor(Request $request) {
        $id = Auth::id();

        if ($request->post('button-filter')) {
            
        }

        $aUserData = Traveller::paginate(2);

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
        ]);
=======
use App\UserData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserDataController extends Controller
{
    
    /*
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
>>>>>>> develop
    }
}

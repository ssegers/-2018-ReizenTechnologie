<?php

namespace App\Http\Controllers;

use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserDataController extends Controller
{
    public function showUsersAsMentor(Request $request) {
        $id = Auth::id();

        $aUserData = [];

        if ($request->post('button-filter')) {
            $aFilterChecked = [
                'email' => $request->post('email'),
                'phone' => $request->post('phone'),
            ];
            $sSelectString = "";

            foreach ($aFilterChecked as $key => $filter) {
                if ($filter) {
                    $sSelectString .= ',' . $key;
                }
            }
            $aUserData = Traveller::select($sSelectString)->paginate(2);
        }
        else {
            $aUserData = Traveller::paginate(2);
        }


        return view('user.filter.filter', [
            'aUserData' => $aUserData,
        ]);
    }
}

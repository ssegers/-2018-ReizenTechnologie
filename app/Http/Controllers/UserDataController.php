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

        if ($request->post('button-filter')) {
            
        }

        $aUserData = Traveller::paginate(2);

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
        ]);
    }
}

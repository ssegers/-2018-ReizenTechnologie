<?php

namespace App\Http\Controllers;

use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    public function showUsersAsMentor() {
        $id = Auth::id();

        $aUserData = Traveller::paginate(2);

        return view('user.filter.filter', [
            'aUserData' => $aUserData,
        ]);
    }
}

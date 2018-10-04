<?php

namespace App\Http\Controllers;

use App\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    public function showUserDataAsMentor() {
        $id = Auth::id();

        $aUserData = Traveller::paginate(25);
    }
}

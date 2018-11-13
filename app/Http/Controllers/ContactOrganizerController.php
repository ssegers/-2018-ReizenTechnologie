<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

class ContactOrganizerController extends Controller
{
    //
    function getInfo(){
        $oTrips = Trip::all();
        $oOrganizers = User::Where('role', 'organizer')
            ->join('travellers','travellers.user_id','=','users.user_id')->select('first_name', 'last_name', 'traveller_id','email')->get();

        return view( 'admin.contact.contact',
            [
                'aTrips' => $oTrips,
                'aOrganizers' => $oOrganizers,
            ]);
    }
}

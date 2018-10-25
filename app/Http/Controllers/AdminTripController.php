<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminTripController extends Controller
{
    //GET::/admin/trips
    function getTrips()
    {
        $aTrips = DB::table('trips')->get();
        return view('admin.trips.trips', ['aTripData' => $aTrips]);

    }

    //GET::/admin/trips/new
    //POST::/admin/trips/new

    //GET::/admin/trips/{id}
    function getTripByID($id)
    {
        $oTrip = DB::table('trips')->where('trip_id', '=', $id)->first();
        return view('admin.trips.singleTrip', ['oTrip' =>$oTrip]); //moet naar een popup gaan, view target is niet juist
    }
    //POST::/admin/trips/{id}
    function UpdateOrCreateTrip(Request $request)
    {

    }



}

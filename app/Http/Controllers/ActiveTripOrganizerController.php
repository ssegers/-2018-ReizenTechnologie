<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\TripOrganizer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveTripOrganizerController extends Controller
{
    /*
     * This function will show the ActiveTripOrganizer view
     */
    public function showForm() {
        $oActiveTrips = Trip::Where('is_active', true)->get();
        $iTripId = $oActiveTrips[0]->trip_id;
        
        $oCurrentMentorsId = TripOrganizer::Where('trip_id', $iTripId)->get()->toArray();
        $oCurrentMentors = Traveller::Where('traveller_id', $oCurrentMentorsId)->get();
        return view( 'user.ActiveTripOrganizer',
            [
                'aActiveTrips' => $oActiveTrips,
                'aCurrentMentors' => $oCurrentMentors,
                ]);
    }
}

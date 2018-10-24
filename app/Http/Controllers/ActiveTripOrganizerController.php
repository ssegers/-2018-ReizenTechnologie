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
        $firstActiveTrip = $oActiveTrips->first();
        $iTripId = $firstActiveTrip->trip_id;
        $aCurrentMentorsId = TripOrganizer::Where('trip_id', $iTripId)->get('traveller_id')->toArray();
        $oCurrentMentors = Traveller::Where('traveller_id', $aCurrentMentorsId)->get();

        return view( 'user.ActiveTripOrganizer',
            [
                'aActiveTrips' => $oActiveTrips,
                'aCurrentMentors' => $oCurrentMentors,
                ]);
    }
}

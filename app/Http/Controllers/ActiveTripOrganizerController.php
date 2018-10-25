<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\TripOrganizer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ActiveTripOrganizerController extends Controller
{
    private $oActiveTrips;
    /*
     * This function will show the ActiveTripOrganizer view
     */
    public function showActiveTrips() {
        $this->oActiveTrips = Trip::Where('is_active', true)->get();
        return view( 'user.ActiveTripOrganizer',
            [
                'aActiveTrips' => $this->oActiveTrips,
                ]);
    }

    public function showLinkedOrganisators(Request $request) {

        $this->oActiveTrips = Trip::Where('is_active', true)->get();
        $iTripId = $request->post('trip_id');

        $aUserId = TripOrganizer::Select('traveller_id')->where('trip_id', $iTripId)->get();

        $oMentors = Traveller::Select('traveller_id','first_name', 'last_name')
            ->whereIn('traveller_id', $aUserId)
            ->orderBy('first_name')
            ->get();
        return response()->json(['aMentors' => $oMentors]);
    }

    public function removeLinkedOrganisator($iTravellerId) {
        return response('Trying to delete ' + $iTravellerId);
        TripOrganizer::Where('traveller_id', $iTravellerId)->delete();

    }
}

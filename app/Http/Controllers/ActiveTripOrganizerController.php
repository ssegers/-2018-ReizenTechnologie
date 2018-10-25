<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\Trip;
use App\TripOrganizer;
use App\User;
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
        //$oOrganizers = User::Where('role', 'organizer')->get();
        $oOrganizers = User::Where('role', 'organizer')
            ->join('travellers','travellers.user_id','=','users.user_id')->select('first_name', 'last_name', 'traveller_id')->get();
        return view( 'user.ActiveTripOrganizer',
            [
                'aActiveTrips' => $this->oActiveTrips,
                'aOrganizers' => $oOrganizers,
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

    public function removeLinkedOrganisator(Request $request) {
        //get trip id aswell
        $iTripId = $request->post('trip_id');
        $iTravellerId = $request->post('traveller_id');

        return response(TripOrganizer::Where('traveller_id', $iTravellerId)->where('trip_id', $iTripId)->delete());
    }
}

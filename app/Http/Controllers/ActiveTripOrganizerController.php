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
    /*
     * This function will show the ActiveTripOrganizer view
     */
    public function showActiveTrips() {
        $oActiveTrips = Trip::Where('is_active', true)->get();
        //$oOrganizers = User::Where('role', 'organizer')->get();
        $oOrganizers = User::Where('role', 'organizer')
            ->join('travellers','travellers.user_id','=','users.user_id')->select('first_name', 'last_name', 'traveller_id')->get();

        return view( 'admin.trips.ActiveTripOrganizer',
            [
                'aActiveTrips' => $oActiveTrips,
                'aOrganizers' => $oOrganizers,
                ]);
    }

    public function showLinkedOrganisators(Request $request) {
        $iTripId = $request->post('trip_id');
        $aUserId = TripOrganizer::Select('traveller_id')->where('trip_id', $iTripId)->get();
        $oMentors = Traveller::Select('traveller_id','first_name', 'last_name')
            ->whereIn('traveller_id', $aUserId)
            ->orderBy('first_name')
            ->get();
        return response()->json(['aMentors' => $oMentors]);
    }

    public function addLinkedOrganisator(Request $request) {
        $validator = \Validator::make($request->all(), [
            'traveller_ids' => 'required',
            'trip_id' => 'required',
            ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $aTravellerId = $request->post('traveller_ids');
        $iTripId = $request->post('trip_id');
        for ($i = 0; $i < count($aTravellerId); $i++) {
            if (!(TripOrganizer::where('traveller_id', '=', $aTravellerId[$i])->where('trip_id', $iTripId)->exists())) {
                $linkedOrganizer = new TripOrganizer();
                $linkedOrganizer->traveller_id = $aTravellerId[$i];
                $linkedOrganizer->trip_id = $iTripId;
                $linkedOrganizer->save();
            }
        }
        $aUserId = TripOrganizer::Select('traveller_id')->where('trip_id', $iTripId)->get();
        $oMentors = Traveller::Select('traveller_id','first_name', 'last_name')
            ->whereIn('traveller_id', $aUserId)
            ->orderBy('first_name')
            ->get();
//        $request->session()->flash('alert-success', 'Het opslaan van begeleiders is gelukt.');
        return response()->json(['aMentors' => $oMentors]);

    }
    public function removeLinkedOrganisator(Request $request) {
        $iTripId = $request->post('trip_id');
        $iTravellerId = $request->post('traveller_id');
//        $request->session()->put('alert-success', 'success');
        return response(TripOrganizer::Where('traveller_id', $iTravellerId)->where('trip_id', $iTripId)->delete());
    }
}

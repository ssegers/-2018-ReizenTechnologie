<?php

namespace App\Http\Controllers;

use App\Traveller;
use App\TravellersPerTrip;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Mpdf\Tag\Tr;

class ActiveTripOrganizerController extends Controller
{

    /**
     * @author Sasha Van de Voorde
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * This function will show the ActiveTripOrganizer view
     */
    public function showActiveTrips() {
        $oActiveTrips = Trip::Where('is_active', true)->get();
        //$oOrganizers = User::Where('role', 'organizer')->get();
        $oGuides = User::Where('role', 'guide')
            ->join('travellers','travellers.user_id','=','users.user_id')->select('first_name', 'last_name', 'traveller_id')->get();

        return view( 'admin.trips.ActiveTripOrganizer',
            [
                'aActiveTrips' => $oActiveTrips,
                'aOrganizers' => $oGuides,
                ]);
    }

    /**
     * @author Sasha Van de Voorde
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Gets request data and gets the linked organisators by means of the request data.
     */
    public function showLinkedOrganisators(Request $request) {
        /*
         * Pak de reis, haal de users op , filter de users op rol organisator
         *
         * Pak de reis, haal de users op , filter de users op rol begeleider
         */
        $iTripId = $request->post('trip_id');

       $aTravellers = TravellersPerTrip::with('traveller')->where('trip_id', $iTripId)->where('is_organizer', true)->get();
       $aMentors = [];
       foreach($aTravellers as $traveller) {
                array_push($aMentors, $traveller->traveller);
        }
        return response()->json(['aMentors' => $aMentors]);
    }

    /**
     * @author Sasha Van de Voorde
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Validates the request data and adds a linked organisator.
     */
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
                $oOrganizer = TravellersPerTrip::where('traveller_id', '=', $aTravellerId[$i])->where('trip_id', '=', $iTripId)->first();
              if($oOrganizer != null){
                  $oOrganizer->is_organizer = true;
                  $oOrganizer->save();
              } else {
                  $oOrganizer = new TravellersPerTrip();
                  $oOrganizer->traveller_id = $aTravellerId[$i];
                  $oOrganizer->trip_id = $iTripId;
                  $oOrganizer->is_organizer = true;
                  $oOrganizer->save();
              }

           // return response()->json(['organizer' => $oOrganizer]);
        }
       $request->session()->flash('alert-success', 'Het opslaan van begeleiders is gelukt.');
        return response()->json(['success' => true]);
    }

    /**
     * @author Sasha Van de Voorde
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * Gets the request data and removes the linked organisator based on his id.
     */
    public function removeLinkedOrganisator(Request $request)
    {
        //is_organizer veld op false zetten in TravellersPerTrip

        $iTripId = $request->post('trip_id');
        $iTravellerId = $request->post('traveller_id');
        $oTravellerPerTrip = TravellersPerTrip::where(['traveller_id' => $iTravellerId, 'trip_id'=> $iTripId])->first();
        $oTravellerPerTrip->is_organizer = false;
        $oTravellerPerTrip->save();
        $request->session()->flash('alert-success', 'Het verwijderen van de begeleider is gelukt.');

    }
}

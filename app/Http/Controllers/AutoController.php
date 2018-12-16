<?php

namespace App\Http\Controllers;

use App\Auto;
use App\AutosPerTrip;
use App\TravellersPerAuto;
use App\TravellersPerTrip;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutoController extends Controller
{
    function getAutosPerTripOrganizer(Request $request)
    {
        $oUser=Auth::user();
        if($oUser->role=='admin'){
            $aIsOrganizerOfTrip = TravellersPerTrip::select('trip_id')->get();

            $aActiveTrips = Trip::where('is_active', true)->whereIn('trip_id',$aIsOrganizerOfTrip)->get();

            if ($request->post('selectedActiveTrip') == null) {
                $iTripId = Trip::where('is_active', true)->whereIn('trip_id',$aIsOrganizerOfTrip)->first();
            } else {
                $iTripId = Trip::where('trip_id', $request->post('selectedActiveTrip'))->select('trip_id')->first();
            }

            $aAutoid = AutosPerTrip::whereIn('trip_id', $iTripId)->select('auto_id')->get();

            $aAutosPerTrip = AutosPerTrip::whereIn('autos.auto_id', $aAutoid)
                ->where('trip_id', $iTripId->trip_id)
                ->join('autos', 'autos_per_trips.auto_id', '=', 'autos.auto_id')
                ->get();


            $aAutos = Auto::join('autos_per_trips', 'autos.auto_id', '=', 'autos_per_trips.auto_id')->get();

            $aCurrentOccupation = array();
            $aTravellerPerAuto = array();

            foreach ($aAutos as $oAuto)
            {
                $aCurrentOccupation[$oAuto->auto_id] = TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)->count();
                $aTravellerPerAuto[$oAuto->auto_id]=TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)
                    ->join('travellers','travellers_per_autos.traveller_id','=','travellers.traveller_id')
                    ->get();
            }

            $userTravellerId="admin";

            return view('organiser.CarsAndSeats.cars',
                [
                    'aAutosPerTrip' => $aAutosPerTrip,
                    'aActiveTrips' => $aActiveTrips,
                    'iTripId' => $iTripId,
                    'aCurrentOccupation' => $aCurrentOccupation,
                    'aTravellerPerAuto' =>$aTravellerPerAuto,
                    'userTravellerId'=>$userTravellerId
                ]);
        }
        else{
            foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
                $is_organizer=$travellersPerTrip->is_organizer;
                if($is_organizer){
                    $travellerId=$oUser->traveller->traveller_id;
                    $aIsOrganizerOfTrip=TravellersPerTrip::where('traveller_id',$travellerId)->where('is_organizer',true)->select('trip_id')->get();

                    if ($request->post('selectedActiveTrip') == null) {
                        $iTripId = Trip::where('is_active', true)->whereIn('trip_id',$aIsOrganizerOfTrip)->first();
                    } else {
                        $iTripId = Trip::where('trip_id', $request->post('selectedActiveTrip'))->select('trip_id')->first();
                    }
                    $aAutoid = AutosPerTrip::whereIn('trip_id', $iTripId)->select('auto_id')->get();

                    $aAutosPerTrip = AutosPerTrip::whereIn('autos.auto_id', $aAutoid)
                        ->where('trip_id', $iTripId->trip_id)
                        ->join('autos', 'autos_per_trips.auto_id', '=', 'autos.auto_id')
                        ->get();


                    $aActiveTrips = Trip::where('is_active', true)->whereIn('trip_id',$aIsOrganizerOfTrip)->get();

                    $aAutos = Auto::join('autos_per_trips', 'autos.auto_id', '=', 'autos_per_trips.auto_id')->get();

                    $aCurrentOccupation = array();
                    $aTravellerPerAuto = array();

                    foreach ($aAutos as $oAuto)
                    {
                        $aCurrentOccupation[$oAuto->auto_id] = TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)->count();
                        $aTravellerPerAuto[$oAuto->auto_id]=TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)
                            ->join('travellers','travellers_per_autos.traveller_id','=','travellers.traveller_id')
                            ->get();
                    }

                    $userTravellerId=$oUser->traveller->traveller_id;

                    return view('organiser.CarsAndSeats.cars',
                        [
                            'aAutosPerTrip' => $aAutosPerTrip,
                            'aActiveTrips' => $aActiveTrips,
                            'iTripId' => $iTripId,
                            'aCurrentOccupation' => $aCurrentOccupation,
                            'aTravellerPerAuto' =>$aTravellerPerAuto,
                            'userTravellerId'=>$userTravellerId
                        ]);
                }
            }
            return $this->getAutosPerTripUser();
        }

    }

    function getAutosPerTripUser(){
        $oUser=Auth::user();
        foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
            $iTripId=$travellersPerTrip->trip_id;
        }
        $aAutosid = AutosPerTrip::where('trip_id', $iTripId)->select('auto_id')->get();

        $aAutosPerTrip=AutosPerTrip::whereIn('autos.auto_id', $aAutosid)
            ->join('autos','autos_per_trips.auto_id','=','autos.auto_id')
            ->get();

        if($oUser->role=='guide'){
            $travellerId=$oUser->traveller->traveller_id;
            $oTripId=TravellersPerTrip::where('traveller_id',$travellerId)->where('is_guide',true)->select('trip_id')->first();
            $aTrip=Trip::where('trip_id',$oTripId->trip_id)->first();
        }
        else{
            $aTrip=Trip::where('trip_id',$iTripId)->first();
        }

        $aAutos = Auto::join('autos_per_trips', 'autos.auto_id', '=', 'autos_per_trips.auto_id')->get();

        $aCurrentOccupation = array();
        $aTravellerPerAuto = array();

        foreach ($aAutos as $oAuto)
        {
            $aCurrentOccupation[$oAuto->auto_id] = TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)->count();
            $aTravellerPerAuto[$oAuto->auto_id]=TravellersPerAuto::join('autos_per_trips','travellers_per_autos.autos_per_trip_id','autos_per_trips.autos_per_trip_id')->where('auto_id', $oAuto->auto_id)
                ->join('travellers','travellers_per_autos.traveller_id','=','travellers.traveller_id')
                ->get();
        }

        $userTravellerId=$oUser->traveller->traveller_id;


        return view('user.CarsAndSeats.cars',
            [
                'aAutosPerTrip'=>$aAutosPerTrip,
                'aTrip'=>$aTrip,
                'aCurrentOccupation' => $aCurrentOccupation,
                'aTravellerPerAuto' =>$aTravellerPerAuto,
                'userTravellerId'=>$userTravellerId
            ]);
    }

    function createAuto(Request $request)
    {
        $oAuto=new Auto();
        $oAuto->auto_name=$request->post('AutoNaam');
        $oAuto->size=$request->post('AutoSize');
        $oAuto->save();

        $oAutoPerTrip=new AutosPerTrip();
        $oAutoPerTrip->auto_id=$oAuto->auto_id;
        $oAutoPerTrip->trip_id=$request->post('TripId');
        $oAutoPerTrip->save();


        return redirect()->back();
    }

    function chooseSeat(Request $request){
        $oUser = Auth::user();
        if($oUser->role="admin"){
            return redirect()->back()->with('errormessage', 'U kunt geen auto kiezen als administrator');
        }
        else {
            $userTravellerId = $oUser->traveller->traveller_id;
            $chosenTravellers = TravellersPerAuto::select("traveller_id")->get();
            foreach ($chosenTravellers as $traveller) {
                if ($traveller->traveller_id == $userTravellerId) {
                    return redirect()->back()->with('errormessage', 'U heeft al een auto gekozen');
                }
            }
            $oTravellerPerAuto = new TravellersPerAuto();
            $oTravellerPerAuto->autos_per_trip_id = $request->post('autos_per_trip_id');
            $oTravellerPerAuto->traveller_id = $userTravellerId;
            $oTravellerPerAuto->save();
            return redirect()->back();
        }
    }
    function leaveSeat(Request $request){
        $oUser = Auth::user();
        if ($oUser->role=='admin'){
            $userTravellerId=$request->post('traveller_id');
            $travellerPerAuto = TravellersPerAuto::where('traveller_id', $userTravellerId)->firstOrFail();
            $travellerPerAuto->delete();
            return redirect()->back()->with('succesmessage', 'De reiziger nu een andere kamer kiezen');
        }
        else{
            $userTravellerId=$oUser->traveller->traveller_id;
            $travellerPerAuto = TravellersPerAuto::where('traveller_id', $userTravellerId)->firstOrFail();
            $travellerPerAuto->delete();
            return redirect()->back()->with('succesmessage', 'U kunt nu een andere kamer kiezen');
        }
    }

    public function deleteAuto(Request $request){

        $auto_id=$request->input('auto_id');

        AutosPerTrip::where('autos_per_trip_id',$request->post('autos_per_trip_id'))->delete();

        Auto::where('auto_id',$auto_id)->delete();
        return redirect()->back()->with('message', 'De auto is verwijderd');
    }
}
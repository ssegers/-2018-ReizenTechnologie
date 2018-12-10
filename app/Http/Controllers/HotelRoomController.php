<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\HotelsPerTrip;
use App\RoomsPerHotelPerTrip;
use App\TravellersPerRoom;
use App\TravellersPerTrip;
use App\Trip;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HotelRoomController extends Controller
{
    function getHotelsPerTrip(Request $request)
    {
        //Haal trip id van de ingelogde traveller
        $oUser = Auth::user();
        if ($oUser->role == 'guide')
        {
            if ($request->post('selectedActiveTrip')==null){
                $iTripId=Trip::where('is_active',true)->select('trip_id')->first();
            }
            else {
                $iTripId = Trip::where('trip_id', $request->post('selectedActiveTrip'))->select('trip_id')->first();
            }
            $aHotelsid = HotelsPerTrip::whereIn('trip_id', $iTripId)->select('hotel_id')->get();

            //Haal alle hotel gegevens met de gevonden hotelIds

            $aHotelsPerTrip=HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                ->join('hotels','hotels_per_trips.hotel_id','=','hotels.hotel_id')
                ->get();

            $aActiveTrips=Trip::where('is_active',true)->get();

            $aHotels=Hotel::get();

            return view('user.HotelsAndRooms.hotels',
                [
                    'aHotelsPerTrip'=>$aHotelsPerTrip,
                    'aHotels'=>$aHotels,
                    'aActiveTrips'=>$aActiveTrips,
                    'iTripId'=>$iTripId
                ]);
        }
        else{
            foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
                $iTripId=$travellersPerTrip->trip_id;
            }
            $aHotelsid = HotelsPerTrip::where('trip_id', $iTripId)->select('hotel_id')->get();
            //Haal alle hotel gegevens met de gevonden hotelIds

            $aHotelsPerTrip=HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                ->join('hotels','hotels_per_trips.hotel_id','=','hotels.hotel_id')
                ->get();

            $aActiveTrips=Trip::where('is_active',true)->get();

            return view('user.HotelsAndRooms.hotels',
                [
                    'aHotelsPerTrip'=>$aHotelsPerTrip,
                    'aActiveTrips'=>$aActiveTrips
                ]);
        }
    }

    function getRooms($hotel_id,Request $request)
    {
        $oUser=Auth::user();
        $userTravellerId=$oUser->traveller->traveller_id;

        $hotel_name=$request->post("hotel_name");
        $aRooms = RoomsPerHotelPerTrip::where('hotels_per_trip_id', $hotel_id)->get();
        $aCurrentOccupation = array();
        $aTravellerPerRoom = array();

        foreach ($aRooms as $oRoom)
        {
            $aCurrentOccupation[$oRoom->rooms_hotel_trip_id] = TravellersPerRoom::where('rooms_hotel_trip_id', $oRoom->rooms_hotel_trip_id)->count();
            $aTravellerPerRoom[$oRoom->rooms_hotel_trip_id]=TravellersPerRoom::where('rooms_hotel_trip_id', $oRoom->rooms_hotel_trip_id)
                ->join('travellers','travellers_per_rooms.traveller_id','=','travellers.traveller_id')
                ->get();
        }
        return view('user.HotelsAndRooms.rooms',
            [
                'userTravellerId'=>$userTravellerId,
                'hotel_id'=>$hotel_id,
                'hotel_name'=>$hotel_name,
                'aRooms' => $aRooms,
                'aCurrentOccupation' => $aCurrentOccupation,
                'aTravellerPerRoom' =>$aTravellerPerRoom
            ]);
    }

    function createHotel(Request $request)
    {
        $oUser = Auth::user();

        if ($oUser->role == 'guide')
        {
            $oHotel=new Hotel();
            $oHotel->hotel_name=$request->post('Hotelnaam');
            $oHotel->address=$request->post('Adres');
            $oHotel->phone=$request->post('Telnr');
            $oHotel->email=$request->post('EmailHotel');
            $oHotel->save();

            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    function addHotelRoom(Request $request){
        $oUser = Auth::user();

        if ($oUser->role == 'guide')
        {
            $oRoom=new RoomsPerHotelPerTrip();
            $oRoom->hotels_per_trip_id=$request->post('hotels_per_trip_id');
            $oRoom->size=$request->post('AantalPersonen');
            $oRoom->save();

            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    function chooseRoom(Request $request){
        $oUser = Auth::user();
        $userTravellerId=$oUser->traveller->traveller_id;
        $chosenTravellers=TravellersPerRoom::select("traveller_id")->get();
        foreach ($chosenTravellers as $traveller) {
            if ($traveller->traveller_id == $userTravellerId) {
                return redirect()->back()->with('errormessage', 'U heeft al een kamer gekozen');
            }
        }
        $oTravellerPerRoom=new TravellersPerRoom();
        $oTravellerPerRoom->rooms_hotel_trip_id=$request->post('rooms_hotel_trip_id');
        $oTravellerPerRoom->traveller_id=$userTravellerId;
        $oTravellerPerRoom->save();
        return redirect()->back();


    }

    function leaveRoom(Request $request){
        $oUser = Auth::user();
        $userTravellerId=$oUser->traveller->traveller_id;
        $travellerPerRoom = TravellersPerRoom::where('traveller_id', $userTravellerId)->firstOrFail();
        $travellerPerRoom->delete();
        return redirect()->back()->with('succesmessage', 'U kunt nu een andere kamer kiezen');
    }

    public function connectHotelToTrip(Request $request){
        $oHotelsPerTrip=new HotelsPerTrip();
        $oHotelsPerTrip->trip_id=$request->post('trip_id');
        $oHotelsPerTrip->hotel_id=$request->post('hotel_id');
        $oHotelsPerTrip->hotel_start_date=$request->post('Startdatum');
        $oHotelsPerTrip->hotel_end_date=$request->post('Einddatum');
        $oHotelsPerTrip->save();

        return redirect()->back();
    }

    public function deleteHotel(Request $request){

        $hotels_per_trip_id=$request->input('hotels_per_trip_id');

        HotelsPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->delete();
        return redirect()->back()->with('message', 'Het hotel is verwijderd');
    }


}

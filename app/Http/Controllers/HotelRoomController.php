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
    //GET::/listhotels
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

            $aHotels=HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                ->join('hotels','hotels_per_trips.hotel_id','=','hotels.hotel_id')
                ->get();

            $aActiveTrips=Trip::where('is_active',true)->get();

            return view('user.HotelsAndRooms.hotels',
                [
                    'aHotels'=>$aHotels,
                    'aActiveTrips'=>$aActiveTrips,
                    'iTripId'=>$iTripId
                ]);
        }
        else{
            $iTripId=null;
            foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
                $iTripId=$travellersPerTrip->trip_id;
            }
            $aHotelsid = HotelsPerTrip::where('trip_id', $iTripId)->select('hotel_id')->get();
            //Haal alle hotel gegevens met de gevonden hotelIds

            $aHotels=HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                ->join('hotels','hotels_per_trips.hotel_id','=','hotels.hotel_id')
                ->get();

            $aActiveTrips=Trip::where('is_active',true)->get();

            return view('user.HotelsAndRooms.hotels',
                [
                    'aHotels'=>$aHotels,
                    'aActiveTrips'=>$aActiveTrips
                ]);
        }
    }

    //GET::/listrooms/{{hotels_per_trip_id}}
    function getRooms($iHotelsPerTripId)
    {
        $aRooms = RoomsPerHotelPerTrip::where('hotels_per_trip_id', $iHotelsPerTripId)->get();
        $aCurrentOccupation = array();
        foreach ($aRooms as $oRoom)
        {
            $aCurrentOccupation[$oRoom->rooms_hotel_trip_id] = TravellersPerRoom::where('rooms_hotel_trip_id', $oRoom->rooms_hotel_trip_id)->count();
        }
        return view('user.HotelsAndRooms.rooms',
            [
                'aRooms' => $aRooms,
                'aCurrentOccupation' => $aCurrentOccupation,
            ]);
    }

    //GET::/listtravellers/{{room_hotel_trip_id}}
    function getTravellers($iRoomHotelTripId)
    {
        $aTravellerIds = TravellersPerRoom::where('room_hotel_trip_id', $iRoomHotelTripId)->get();
        //zoek nu alle travellers met de gevonden ids
        //geef deze travellers mee met de view
        return view('user.HotelsAndRooms.travellers');
    }

    //POST::
    function createHotel(Request $request)
    {
        //Indien organisator
        $oUser = Auth::user();

        if ($oUser->role == 'guide')
        {
            $oHotel=new Hotel();
            $oHotel->hotel_name=$request->post('Hotelnaam');
            $oHotel->address=$request->post('Adres');
            $oHotel->phone=$request->post('Telnr');
            $oHotel->email=$request->post('EmailHotel');
            $oHotel->save();
            $iHotelId = Hotel::orderby('created_at','desc')->first()->hotel_id;
            $oHotelsPerTrip=new HotelsPerTrip();
            $oHotelsPerTrip->trip_id=$request->post('trip_id');
            $oHotelsPerTrip->hotel_id=$iHotelId;
            $oHotelsPerTrip->hotel_start_date=$request->post('Startdatum');
            $oHotelsPerTrip->hotel_end_date=$request->post('Einddatum');
            $oHotelsPerTrip->save();

            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
        //Maak een nieuw hotel aan
    }


}

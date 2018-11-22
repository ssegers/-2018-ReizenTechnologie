<?php

namespace App\Http\Controllers;

use App\HotelsPerTrip;
use App\RoomsPerHotelPerTrip;
use App\TravellersPerRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelRoomController extends Controller
{
    //GET::/listhotels
    function getHotelsPerTrip()
    {
        //Haal trip id van de ingelogde traveller
        $aHotelIds = HotelsPerTrip::where('trip_id', 1)->get();
        //Haal alle hotel gegevens met de gevonden hotelIds
        return view('user.HotelsAndRooms.hotels', []);
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
        //Maak een nieuw hotel aan
        return redirect('/listhotels/');
    }


}

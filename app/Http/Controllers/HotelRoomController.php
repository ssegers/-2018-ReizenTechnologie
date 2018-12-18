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
    function getHotelsPerTripOrganizer(Request $request)
    {
        $oUser=Auth::user();
        if ($oUser->role=='admin'){
            $aIsOrganizerOfTrip = TravellersPerTrip::select('trip_id')->get();

            $aActiveTrips = Trip::where('is_active', true)->whereIn('trip_id', $aIsOrganizerOfTrip)->get();

            $aHotels = Hotel::get();

            if ($request->post('selectedActiveTrip') == null) {
                $iTripId = Trip::where('is_active', true)->whereIn('trip_id', $aIsOrganizerOfTrip)->first();
            } else {
                $iTripId = Trip::where('trip_id', $request->post('selectedActiveTrip'))->select('trip_id')->first();
            }
            $aHotelsid = HotelsPerTrip::whereIn('trip_id', $iTripId)->select('hotel_id')->get();

            $aHotelsPerTrip = HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                ->where('trip_id', $iTripId->trip_id)
                ->join('hotels', 'hotels_per_trips.hotel_id', '=', 'hotels.hotel_id')
                ->orderBy('hotel_start_date', 'asc')
                ->get();

            return view('organiser.HotelsAndRooms.hotels',
                [
                    'aHotelsPerTrip' => $aHotelsPerTrip,
                    'aHotels' => $aHotels,
                    'aActiveTrips' => $aActiveTrips,
                    'iTripId' => $iTripId
                ]);
        }
        else {
            foreach ($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
                $is_organizer = $travellersPerTrip->is_organizer;
                if ($is_organizer) {
                    $travellerId = $oUser->traveller->traveller_id;
                    $aIsOrganizerOfTrip = TravellersPerTrip::where('traveller_id', $travellerId)->where('is_organizer', true)->select('trip_id')->get();

                    if ($request->post('selectedActiveTrip') == null) {
                        $iTripId = Trip::where('is_active', true)->whereIn('trip_id', $aIsOrganizerOfTrip)->first();
                    } else {
                        $iTripId = Trip::where('trip_id', $request->post('selectedActiveTrip'))->select('trip_id')->first();
                    }
                    $aHotelsid = HotelsPerTrip::whereIn('trip_id', $iTripId)->select('hotel_id')->get();

                    $aHotelsPerTrip = HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
                        ->where('trip_id', $iTripId->trip_id)
                        ->join('hotels', 'hotels_per_trips.hotel_id', '=', 'hotels.hotel_id')
                        ->orderBy('hotel_start_date', 'asc')
                        ->get();


                    $aActiveTrips = Trip::where('is_active', true)->whereIn('trip_id', $aIsOrganizerOfTrip)->get();

                    $aHotels = Hotel::get();

                    return view('organiser.HotelsAndRooms.hotels',
                        [
                            'aHotelsPerTrip' => $aHotelsPerTrip,
                            'aHotels' => $aHotels,
                            'aActiveTrips' => $aActiveTrips,
                            'iTripId' => $iTripId
                        ]);
                }
            }
            return $this->getHotelsPerTripUser();
        }
    }

    function getHotelsPerTripUser(){
        $oUser=Auth::user();
        foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
            $iTripId=$travellersPerTrip->trip_id;
        }
        $aHotelsid = HotelsPerTrip::where('trip_id', $iTripId)->select('hotel_id')->get();
        //Haal alle hotel gegevens met de gevonden hotelIds

        $aHotelsPerTrip=HotelsPerTrip::whereIn('hotels.hotel_id', $aHotelsid)
            ->join('hotels','hotels_per_trips.hotel_id','=','hotels.hotel_id')
            ->get();

        if($oUser->role=='guide'){
            $travellerId=$oUser->traveller->traveller_id;
            $oTripId=TravellersPerTrip::where('traveller_id',$travellerId)->where('is_guide',true)->select('trip_id')->first();
            $aTrip=Trip::where('trip_id',$oTripId->trip_id)->first();
        }
        else{
            $aTrip=Trip::where('trip_id',$iTripId)->first();
        }


        return view('user.HotelsAndRooms.hotels',
            [
                'aHotelsPerTrip'=>$aHotelsPerTrip,
                'aTrip'=>$aTrip
            ]);
    }

    function getRoomsOrganisator($hotel_id,$hotel_name)
    {
        $oUser=Auth::user();
        if($oUser->role=='admin'){
            $userTravellerId='admin';
        }
        else{
            $userTravellerId=$oUser->traveller->traveller_id;
        }

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
        return view('organiser.HotelsAndRooms.rooms',
            [
                'userTravellerId'=>$userTravellerId,
                'hotel_id'=>$hotel_id,
                'hotel_name'=>$hotel_name,
                'aRooms' => $aRooms,
                'aCurrentOccupation' => $aCurrentOccupation,
                'aTravellerPerRoom' =>$aTravellerPerRoom
            ]);
    }
    function getRoomsUser($hotel_id,$hotel_name){
        $oUser=Auth::user();
        $userTravellerId=$oUser->traveller->traveller_id;

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
        $oHotel=new Hotel();
        $oHotel->hotel_name=$request->post('Hotelnaam');
        $oHotel->address=$request->post('Adres');
        $oHotel->phone=$request->post('Telnr');
        $oHotel->email=$request->post('EmailHotel');
        $oHotel->save();

        return redirect()->back();
    }

    function addHotelRoom(Request $request){
        $oUser = Auth::user();
        $is_organizer=false;

        if($oUser->role!='admin'){
            foreach($oUser->traveller->travellersPerTrip as $travellersPerTrip) {
                $is_organizer=$travellersPerTrip->is_organizer;
            }
        }
        if (($oUser->role == 'guide'&& $is_organizer)||($oUser->role=='admin'))
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
        if($oUser->role=='admin'){
            return redirect()->back()->with('errormessage', 'U kunt geen kamer kiezen als administrator');;
        }
        else{
            $userTravellerId=$oUser->traveller->traveller_id;
            $chosenTravellers=RoomsPerHotelPerTrip::join('travellers_per_rooms','rooms_per_hotel_per_trips.rooms_hotel_trip_id','=','travellers_per_rooms.rooms_hotel_trip_id')
                ->where('hotels_per_trip_id',$request->post('hotels_per_trip_id'))
                ->select("traveller_id")
                ->get();
            foreach ($chosenTravellers as $traveller) {
                if ($traveller->traveller_id == $userTravellerId) {
                    return redirect()->back()->with('errormessage', 'U heeft al een kamer gekozen in dit hotel');
                }
            }
            $oTravellerPerRoom=new TravellersPerRoom();
            $oTravellerPerRoom->rooms_hotel_trip_id=$request->post('rooms_hotel_trip_id');
            $oTravellerPerRoom->traveller_id=$userTravellerId;
            $oTravellerPerRoom->save();
            return redirect()->back();
        }
    }

    function leaveRoom(Request $request){
        $oUser = Auth::user();
        if ($oUser->role=='admin'){
            $userTravellerId=$request->post('traveller_id');
            $travellerPerRoom = TravellersPerRoom::where('rooms_hotel_trip_id',$request->post('rooms_hotel_trip_id'))->where('traveller_id', $userTravellerId)->firstOrFail();
            $travellerPerRoom->delete();
            return redirect()->back()->with('succesmessage', 'De reiziger kan nu een andere kamer kiezen');
        }
        else{
            $userTravellerId=$oUser->traveller->traveller_id;
            $travellerPerRoom = TravellersPerRoom::where('rooms_hotel_trip_id',$request->post('rooms_hotel_trip_id'))->where('traveller_id', $userTravellerId)->firstOrFail();
            $travellerPerRoom->delete();
            return redirect()->back()->with('succesmessage', 'U kunt nu een andere kamer kiezen');
        }
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

        $aRoomsId=RoomsPerHotelPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->select('rooms_hotel_trip_id')->get();
        TravellersPerRoom::whereIn('rooms_hotel_trip_id',$aRoomsId)->delete();
        RoomsPerHotelPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->delete();
        HotelsPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->delete();
        return redirect()->back()->with('message', 'Het hotel is verwijderd');
    }

    public function deleteHotelRoom(Request $request){

        TravellersPerRoom::where('rooms_hotel_trip_id',$request->post('rooms_hotel_trip_id'))->delete();
        RoomsPerHotelPerTrip::where('rooms_hotel_trip_id',$request->post('rooms_hotel_trip_id'))->delete();
        return redirect()->back()->with('message', 'De hotelkamer is verwijderd');
    }


}

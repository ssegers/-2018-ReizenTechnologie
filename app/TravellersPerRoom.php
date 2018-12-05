<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravellersPerRoom extends Model
{
    //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    protected $primaryKey = 'travellers_per_room_id';

    public function traveller()
    {
        return $this->belongsTo('App\Traveller', 'traveller_id', 'traveller_id');
    }

    public function roomPerHotelPerTrip()
    {
        return $this->belongsTo('App\RoomsPerHotelPerTrip', 'rooms_hotel_trip_id', 'rooms_hotel_trip_id');
    }
}

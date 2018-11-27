<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsPerHotelPerTrip extends Model
{
    //
    protected $primaryKey = 'rooms_hotel_trip_id';

    public function hotelsPerTrip()
    {
        return $this->belongsTo('App\HotelsPerTrip');
    }
}

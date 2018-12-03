<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelsPerTrip extends Model
{
    //
    protected $primaryKey = 'hotels_per_trip_id';


    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id', 'trip_id');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel', 'hotel_id', 'hotel_id');
    }

    public function roomPerHotelPerTrip()
    {
        return $this->hasMany('App\RoomsPerHotelPerTrip', 'hotels_per_trip_id', 'hotels_per_trip_id');

    }
}

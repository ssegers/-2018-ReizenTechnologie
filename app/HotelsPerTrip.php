<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelsPerTrip extends Model
{
    //
    protected $primaryKey = 'hotels_per_trip_id';


    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function roomPerHotelPerTrip()
    {
        return $this->hasMany('App\RoomsPerHotelPerTrip');

    }
}

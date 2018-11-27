<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $primaryKey = 'trip_id';

    public function trips()
    {
        return $this->hasMany('App\TravellersPerTrip', 'trip_id', 'trip_id');
    }

    public function hotels()
    {
        return $this->hasMany('App\HotelsPerTrip', 'trip_id', 'trip_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutosPerTrip extends Model
{
    //
    protected $primaryKey = 'autos_per_trip_id';


    public function trip()
    {
        return $this->belongsTo('App\Trip', 'trip_id', 'trip_id');
    }

    public function auto()
    {
        return $this->belongsTo('App\Auto', 'auto_id', 'auto_id');
    }

    public function travellersPerTrip()
    {
        return $this->hasMany('App\TravellersPerAuto', 'autos_per_trip_id', 'autos_per_trip_id');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravellersPerAuto extends Model
{
    protected $primaryKey = 'travellers_per_auto_id';

    public function traveller()
    {
        return $this->belongsTo('App\Traveller', 'traveller_id', 'traveller_id');
    }

    public function AutosPerTrip()
    {
        return $this->belongsTo('App\AutosPerTrip', 'autos_per_trip_id', 'autos_per_trip_id');
    }
}

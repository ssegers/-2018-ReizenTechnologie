<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $primaryKey = 'hotel_id';

    public function hotelsPerTrip()
    {
        return $this->hasMany('App\HotelsPerTrip', 'hotel_id', 'hotel_id');
    }
}

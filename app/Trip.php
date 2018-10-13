<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function traveller()
    {
        return $this->hasMany('App\Traveller', 'trip_id', 'trip_id');
    }
}

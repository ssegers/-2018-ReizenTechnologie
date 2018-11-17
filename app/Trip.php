<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $primaryKey = 'trip_id';

    public function traveller()
    {
        return $this->hasMany('App\Traveller', 'trip_id', 'trip_id');
    }
}

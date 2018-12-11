<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $primaryKey = 'auto_id';

    public function autosPerTrip()
    {
        return $this->hasMany('App\AutosPerTrip', 'auto_id', 'auto_id');
    }
}

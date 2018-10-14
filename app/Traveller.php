<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function zip()
    {
        return $this->belongsTo('App\Zip');
    }
}

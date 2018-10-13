<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function major()
    {
        return $this->hasMany('App\Major', 'study_id', 'study_id');
    }
}

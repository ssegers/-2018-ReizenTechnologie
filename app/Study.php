<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $primaryKey = 'study_id';
    public function major()
    {
        return $this->hasMany('App\Major', 'study_id', 'study_id');
    }
}

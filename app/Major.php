<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $primaryKey = 'major_id';
    public function study()
    {
        return $this->belongsTo('App\Study');
    }

    public function traveller(){
        return $this->hasMany('App\Travellers', 'major_id', 'major_id');
    }
}

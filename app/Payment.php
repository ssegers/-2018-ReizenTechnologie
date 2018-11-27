<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    public function traveller(){
        return $this->hasMany('App\Traveller');
    }

}

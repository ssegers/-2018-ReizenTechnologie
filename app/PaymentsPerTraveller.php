<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentsPerTraveller extends Model
{
    protected $primaryKey = 'paymentPerTraveller_id';

    public function traveller(){
        return $this->hasMany('App\Traveller');
    }
    public static function getPaymentsPerTravellersOverview($traveller_id){

        $userdata= self::where('traveller_id', $traveller_id)->select('traveller_id', 'amount', 'payment_date', 'paymentPerTravellers_id')->get();

        return $userdata;
    }
}

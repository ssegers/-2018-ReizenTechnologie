<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $guarded = ['traveller_id'];
    protected $primaryKey = 'traveller_id';

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

    public $timestamps = false;

    /**
     * Array with data from different tables
     *
     * @author Nico Schelfhout
     *
     * @return mixed
     */
    public static function getTravellersWithPayment(){
        $userdata= self::
        join('majors', 'travellers.major_id', '=', 'majors.major_id')
            ->join('studies','majors.study_id', '=', 'studies.study_id')
            ->join('payments', 'travellers.traveller_id','=','payments.traveller_id')
            ->join('trips','travellers.trip_id', '=', 'trips.trip_id' )
            ->get();
        return $userdata;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Traveller extends Model
{
    protected $guarded = ['traveller_id'];
    protected $primaryKey = 'traveller_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function zip()
    {
        return $this->belongsTo('App\Zip', 'zip_id', 'zip_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id', 'major_id');
    }

    public function travellersPerTrip()
    {
        return $this->hasMany('App\TravellersPerTrip', 'traveller_id', 'traveller_id');

    }
    public function travellersPerRoom()
    {
        return $this->hasMany('App\TravellersPerRoom', 'traveller_id', 'traveller_id');

    }
    public $timestamps = false;

    /**
     * Array with data from different tables
     *
     * @author Nico Schelfhout
     *
     * @return mixed
     */
    public static function getTravellersWithPayment($iTripId){
        $userdata= self::select('last_name','first_name', 'iban', 'price', 'amount', 'travellers_per_trips.traveller_id', 'username')
            ->join('users','travellers.user_id','=','users.user_id')
            ->join('majors','travellers.major_id','=','majors.major_id')
            ->join('travellers_per_trips', 'travellers.traveller_id', '=', 'travellers_per_trips.traveller_id')
            ->join('studies','majors.study_id','=','studies.study_id')
            ->join('trips', 'travellers_per_trips.trip_id','=', 'trips.trip_id')
            ->join('payments', 'travellers.traveller_id','=','payments.traveller_id')
            ->where('travellers_per_trips.trip_id', $iTripId)->where('is_guide', false)->where('is_organizer', false)
            ->groupBy('travellers_per_trips.traveller_id', 'price', 'amount')->get()->toArray();

        return $userdata;
    }

    /*
     * Returns the traveller data based on the trip id and requested datafields. Will return a paginated list if requested
     *
     * @author Yoeri op't Roodt
     *
     * @param $iTripId
     * @param $aDataFields
     * @param null $iPagination (optional)
     *
     * @return mixed
     */
    public static function getTravellersDataByTrip($iTripId, $aDataFields, $iPagination = null) {
        if ($iPagination != null) {
            return self::select(array_keys(array_add($aDataFields, 'username', true)))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('travellers_per_trips', 'travellers.traveller_id', '=', 'travellers_per_trips.traveller_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)->paginate($iPagination);
        }
        else {
            return self::select(array_keys($aDataFields))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('travellers_per_trips', 'travellers.traveller_id', '=', 'travellers_per_trips.traveller_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)->get()->toArray();
        }
    }
}

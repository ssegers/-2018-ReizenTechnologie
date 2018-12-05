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
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)->paginate($iPagination);
        }
        else {
            return self::select(array_keys($aDataFields))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)->get()->toArray();
        }
    }
}

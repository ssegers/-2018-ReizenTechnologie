<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

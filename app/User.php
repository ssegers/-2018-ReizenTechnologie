<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $guarded = ['user_id'];
    protected $primaryKey = 'user_id';
    public function traveller()
    {
        return $this->hasOne('App\Traveller', 'user_id', 'user_id');
    }
    public static function isOrganizer()
    {
        $oUser = Auth::user();
        if($oUser->role=='admin'){
            return true;
        }
        $travellerId=$oUser->traveller->traveller_id;
        $activeTrips=TravellersPerTrip::
        join('trips','travellers_per_trips.trip_id','=','trips.trip_id')
           ->where('is_organizer',true)
            ->where('traveller_id',$travellerId)
            ->where('is_active',true)
            ->get();
        if(count($activeTrips)!=0){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}

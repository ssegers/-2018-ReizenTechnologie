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

    public function zip()
    {
        return $this->belongsTo('App\Zip');
    }

    public function major()
    {
        return $this->belongsTo('App\Major');
    }

    public $timestamps = false;
}

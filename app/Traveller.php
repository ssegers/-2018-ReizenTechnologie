<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $guarded = [];
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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravellersPerTrip extends Model
{
        //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('trip_id', '=', $this->getAttribute('trip_id'))
            ->where('traveller_id', '=', $this->getAttribute('traveller_id'));
        return $query;
    }
    public function traveller()
    {
        return $this->belongsTo('App\Traveller');
    }
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }
}

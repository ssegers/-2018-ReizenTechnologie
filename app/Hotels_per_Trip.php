<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotels_per_Trip extends Model
{
    //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('trip_id', '=', $this->getAttribute('trip_id'))
            ->where('hotel_id', '=', $this->getAttribute('hotel_id'));
        return $query;
    }
}

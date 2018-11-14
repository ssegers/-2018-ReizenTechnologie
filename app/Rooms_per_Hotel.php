<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms_per_Hotel extends Model
{
    //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('hotel_id', '=', $this->getAttribute('hotel_id'))
            ->where('room_id', '=', $this->getAttribute('room_id'));
        return $query;
    }
}

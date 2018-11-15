<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travellers_per_Room extends Model
{
    //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('room_id', '=', $this->getAttribute('room_id'))
            ->where('traveller_id', '=', $this->getAttribute('traveller_id'));
        return $query;
    }
}

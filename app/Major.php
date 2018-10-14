<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public function study()
    {
        return $this->belongsTo('App\Study');
    }
}

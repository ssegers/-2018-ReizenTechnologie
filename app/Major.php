<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $primaryKey = 'major_id';
    public function study()
    {
        return $this->belongsTo('App\Study');
    }
}

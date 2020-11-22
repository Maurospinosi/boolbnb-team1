<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function housesinfo(){
        return $this->belongsTo('App\HouseInfo');
    }
}

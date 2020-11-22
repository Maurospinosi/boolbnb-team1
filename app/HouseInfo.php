<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseInfo extends Model
{
    protected $table = 'houses_info';

    public function house(){
        return $this->belongsTo('App\House');
    }
    public function images(){

        return $this->hasMany('App\Image');
    }
}

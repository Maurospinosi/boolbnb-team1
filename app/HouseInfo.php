<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class HouseInfo extends Model
{
    use Geographical;
    protected $table = 'houses_info';
    protected static $kilometers = true;
    const LATITUDE  = 'lat';
    const LONGITUDE = 'lon';

    public function house(){
        return $this->belongsTo('App\House');
    }
    public function images(){

        return $this->hasMany('App\Image');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function tags(){

        return $this->belongsToMany('App\Tag');
    }

    public function services(){

        return $this->belongsToMany('App\Service');
    }

    public function houseinfo(){
        return $this->hasOne('App\HouseInfo');
    }
    
    public function views(){

        return $this->hasMany('App\View');
    }

    public function messages(){

        return $this->hasMany('App\Message');
    }

    public function sponsors(){

        return $this->belongsToMany('App\Sponsor')->withPivot('start_date', 'end_date');
    }

    protected $guarded = [];
}
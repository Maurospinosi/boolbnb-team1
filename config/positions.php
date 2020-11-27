<?php

use App\HouseInfo;

$positions = [
    {"house_id": "1",
        "lat": "438429",
        "lon": "543785943"},
        {},
    ];

        
$houseInfos = HouseInfo::all();

        
foreach($houseInfos as $houseInfo) {
            
    
    // echo $houseInfo->house_id;

    // $newObj = '{
    //     "house_id": ' . $houseInfo->house_id . ',
    //     "lat": ' . $houseInfo->lat . ',
    //     "lon": ' . $houseInfo->lon .'
    // }';
    
    // $positions[] = $newObj;
}

// $positions = json_decode($positions, true);

// return $positions;


?>
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\House;
use App\HouseInfo;
use App\Message;
use App\View;

use Malhal\Geographical\Geographical;

class ApiController extends Controller
{
    public function getAllHouses()
    {
        $lat = $_GET["lat"];
        $lon = $_GET["lon"];
        $services = $_GET["services"];
        $rooms = $_GET["rooms"];
        $beds = $_GET["beds"];
        $bathrooms = $_GET["bathrooms"];
        $mq = $_GET["mq"];
        $price = $_GET["price"];
        $distance = $_GET["distance"];
        $houses_info = HouseInfo::distance($lat, $lon)
            ->having('distance', '<=', $distance)
            ->orderBy('distance', 'ASC')
            ->where([
                ['rooms', '>=', $rooms],
                ['beds', '>=', $beds],
                ['bathrooms', '>=', $bathrooms],
                ['mq', '>=', $mq],
                ['price', '>=', $price]
            ])
            ->get();
        $housesToPrint = [];
        foreach ($houses_info as $house_info) {
            // Se $services non è vuoto, ciclo sui services per ogni house_info
            if ($services != "") {
                $tempArray = [];
                foreach ($services as $service) {
                    if ($house_info->house->services->contains($service)) {
                        $tempArray[] = $service;
                    }
                }
                if ($tempArray == $services) {
                    $housesToPrint[] = $house_info;
                }
            }
            // Se $services è vuoto, passo tutte le houses_info
            else {
                $house_info->house;
                $housesToPrint[] = $house_info;
            }
        }
        return $housesToPrint;
    }


    public function statistic()
    {
        $house_id = $_GET["id"];
        $year = 2020;

        $house = House::where('id', $house_id)->first();

        $new_arr = [];

        for ($i = 0; $i <= 12; $i++) {

            $views = View::where('house_id', $house_id)
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $i)
                ->get();

            $messages = Message::where('house_id', $house_id)
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $i)
                ->get();

            $new_arr[$i] = ['views' => count($views), 'messages' => count($messages)];
        }

        return $new_arr;
    }
}
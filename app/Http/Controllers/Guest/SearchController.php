<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\House;
use App\HouseInfo;
use App\Sponsor;
use App\Service;
use App\Tag;
use Malhal\Geographical\Geographical;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        
        $lat = $data['lat'];
        $lon = $data['lon'];
        $distance = 20;
        
        $tempHouses_info = HouseInfo::distance($lat, $lon)
                                ->having('distance', '<=', $distance)
                                ->orderBy('distance', 'ASC')->get();

        $houses_info = [];
        foreach($tempHouses_info as $house_info) {
            if(($house_info->house->visible == 1) && count($house_info->house->sponsors) == 0) {
                $houses_info[] = $house_info;
            }
        }

        $sponsors = Sponsor::all();

        $sponsoredHouses = [];

        foreach($tempHouses_info as $house_info) {
            foreach($sponsors as $sponsor) {
                if ($house_info->house->sponsors->contains($sponsor->id) && ($house_info->house->visible == 1)) {
                    $sponsoredHouses[] = $house_info->house;
                }
            }
        }

        $services = Service::all();
        // $services = $services->toJson();
        $tags = Tag::all();

        $nrHouses = count($sponsoredHouses) + count($houses_info);
        
        
        return view('guest.searchresults', compact('houses_info', 'sponsoredHouses', 'nrHouses', 'services', 'tags', 'lat', 'lon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
        
        $distance = 20;
        
        $houses_info = HouseInfo::distance($lat, $lon)
                                ->having('distance', '<=', $distance)
                                ->orderBy('distance', 'ASC')
                                ->where('bathrooms', '<', $bathrooms)
                                ->get();


        
        return $houses_info;
        $allHousesInfos = HouseInfo::all();

        $houses = [];

        foreach ($allHousesInfos as $houseInfo) {
            $houses[] = [
                "house_id" => $houseInfo->house_id,
                "title" => $houseInfo->title,
                "rooms" => $houseInfo->rooms,
                "beds" => $houseInfo->beds,
                "bathrooms" => $houseInfo->bathrooms,
                "mq" => $houseInfo->mq,
                "lat" => $houseInfo->lat,
                "lon" => $houseInfo->lon,
                "price" => $houseInfo->price,
                "cover_image" => $houseInfo->cover_image,
            ];
        }

        return $houses;
    }
}
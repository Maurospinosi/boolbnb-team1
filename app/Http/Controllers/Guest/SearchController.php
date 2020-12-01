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
        
        $houses_info = HouseInfo::distance($lat, $lon)
                                ->having('distance', '<=', $distance)
                                ->orderBy('distance', 'ASC')->get();

       
        
        $sponsors = Sponsor::all();

        $sponsoredHouses = [];

        foreach($houses_info as $house_info) {
            foreach($sponsors as $sponsor) {
                if ($house_info->house->sponsors->contains($sponsor->id)) {
                    $sponsoredHouses[] = $house_info->house_id;
                }
            }
        }

        $services = Service::all();
        // $services = $services->toJson();
        $tags = Tag::all();
        
        
        return view('guest.searchresults', compact('houses_info', 'sponsoredHouses', 'services', 'tags', 'lat', 'lon'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

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
}
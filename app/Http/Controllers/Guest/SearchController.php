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

    
}
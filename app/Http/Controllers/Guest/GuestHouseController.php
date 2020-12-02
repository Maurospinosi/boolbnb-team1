<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\House;
use App\Sponsor;
use App\Image;
use App\Service;
use App\Tag;

class GuestHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();

        $sponsors = Sponsor::all();

        $sponsoredHouses = [];

        foreach($houses as $house) {
            foreach($sponsors as $sponsor) {
                if ($house->sponsors->contains($sponsor->id)) {
                    $sponsoredHouses[] = $house;
                }
            }
        }

        return view('guest.welcome', compact('sponsoredHouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Richiamiamo la casa
        $house = House::where('slug', $slug)->first();

        // Richiamiamo le immagini della casa
        $images = Image::where('houses_info_id', $house->houseinfo->id)->get();

        // Prendiamo i servizi della casa
        $services = Service::all();

        $houseServices = [];

        foreach($services as $service) {
            if ($house->services->contains($service->id)) {
                $houseServices[] = $service->name;
            }
        }

        // Prendiamo i tag della casa
        $tags = Tag::all();

        $houseTags = [];

        foreach($tags as $tag) {
            if ($house->tags->contains($tag->id)) {
                $houseTags[] = $tag->name;
            }
        }


        return view('guest.show', compact('house', 'images', 'houseServices', 'houseTags'));
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
}
<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\House;
use App\Sponsor;
use App\Image;
use App\Service;
use App\Tag;
use App\View;
use Carbon\Carbon;

class GuestHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // Prendiamo tutte le case e le sponsorizzazioni
        $houses = House::where("visible", 1)->inRandomOrder()->get();
        $sponsors = Sponsor::all();

        // Aggiorniamo quali case non sono più sponsorizzate
        foreach($houses as $house) {
            $house->sponsors()->wherePivot('end_date','<', Carbon::now())->detach();
        }

        // Mettiamo le case sponsorizzate in un array
        $sponsoredHouses = [];

        if(count($houses) < 7) {
            $max = count($houses);
        } else {
            $max = 6;
        }

        foreach($houses as $house) {
            foreach($sponsors as $sponsor) {
                if ($house->sponsors->contains($sponsor->id) && count($sponsoredHouses) < $max) {
                    $sponsoredHouses[] = $house;
                }
            }
        }

        $housesToPrint = $sponsoredHouses;
        
        if (count($sponsoredHouses) == 0) {
            $housesToPrint = House::inRandomOrder()->limit(6)->get();
        }

        // Indirizziamo l'utente alla view con le case sponsorizzate
        return view('guest.welcome', compact('housesToPrint'));
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
        
        // Aggiungiamo una "view" perché la casa è stata visitata
        $newView = new View;
        $newView->house_id = $house->id;
        $newView->created_at = Carbon::now();
        $newView->save();

        // Richiamiamo le immagini della casa
        $images = Image::where('houses_info_id', $house->houseinfo->id)->get();

        // Richiamiamo tutti i servizi
        $services = Service::all();

        // Mettiamo i servizi della casa in un array
        $houseServices = [];
        foreach($services as $service) {
            if ($house->services->contains($service->id)) {
                $houseServices[] = $service->name;
            }
        }

        // Richiamiamo tutti i tag
        $tags = Tag::all();

        // Mettiamo i tag della casa in un array
        $houseTags = [];
        foreach($tags as $tag) {
            if ($house->tags->contains($tag->id)) {
                $houseTags[] = $tag->name;
            }
        }

        // Indirizziamo l'utente alla view della casa
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
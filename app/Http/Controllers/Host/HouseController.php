<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
use App\House;
use App\HouseInfo;
use App\Image;
use Illuminate\Support\Facades\Validator;
use App\Service;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $houses = House::where('user_id', $user_id)->get();

        return view ('host.house.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view ("host/house/create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Prendere i dati dal form e fare la validazione
        $data = $request->all();
        // dd($data);

        $request->validate([
            "title"=> "required|max:100",
            "rooms"=> "required",
            "beds"=> "required",
            "bathrooms"=> "required",
            "mq"=> "required",
            "address"=> "required|max:100",
            "country"=> "required|max:60",
            "city"=> "required|max:60",
            "zipcode"=> "required",
            "lat"=> "required|max:20",
            "lon"=> "required|max:20",
            "price"=> "required",
            "cover_image"=> "required|image",
        ]);        


        // $validator = Validator::make($data['url'], [
        //     'photos.profile' => 'required|image',
        // ]);

        // Se sono presenti immagini aggiuntive, si fa la validazione a parte        
        // if(in_array("url", $data)) {
        //     foreach($data["url"] as $urlImage) {

        //         $urlImage->validate([

        //             'url' => 'image',
        
        
        //         ]); 
        
        //         // $validator = Validator::make($urlImage, ["url" => 'image']);

        //         // if ($validator->fails()) {

        //         //     return redirect()->route('/');
        //         //                 ->withErrors($validator)
        //         //                 ->withInput();
        //         // }
        //     }
        // }


        // Salvare l'immagine di copertina in public/storage
        $filename_original = $data['cover_image']->getClientOriginalName();
        $pathCover = Storage::disk('public')->putFileAs('images', $data['cover_image'], $filename_original);
       
        // Creare una nuova casa
        $newHouse = New House;
        $newHouse->user_id = Auth::id();
        $newHouse->slug= Str::of($data["title"])->slug("-");
        if (in_array("visible", $data)) {
            $newHouse->visible = true;
        }
        $newHouse->save();


        if(isset($data['services'])) {
            $services = [];
            foreach($data['services'] as $service) {
                if ($service != "null") {
                    $services[] = $service;
                }
                $newHouse->services()->sync($services);
            }
        }

        // Creare le info per la casa
        $newHouseInfo = New HouseInfo;        
        $newHouseInfo->house_id = $newHouse->id;
        $newHouseInfo->title = $data["title"];
        $newHouseInfo->rooms = $data["rooms"];
        $newHouseInfo->beds = $data["beds"];
        $newHouseInfo->bathrooms = $data["bathrooms"];
        $newHouseInfo->mq = $data["mq"];
        $newHouseInfo->description = $data["description"];
        $newHouseInfo->address = $data["address"];
        $newHouseInfo->city = $data["city"];
        $newHouseInfo->country = $data["country"];
        $newHouseInfo->zipcode = $data["zipcode"];
        $newHouseInfo->lat = $data["lat"];
        $newHouseInfo->lon = $data["lon"];
        $newHouseInfo->price = $data["price"];
        $newHouseInfo->cover_image = $pathCover;
        $newHouseInfo->save();


        // Se sono presenti immagini aggiuntive, inserirle nella tabella images
        if (isset($data['url'])) {

           foreach($data["url"] as $urlImage) {
            //    dd($urlImage);

            // Salvare le immagini in public/storage
            $filename_original = $urlImage->getClientOriginalName();
            $pathUrl = Storage::disk('public')->putFileAs('images', $urlImage, $filename_original);

            $newHouseImages = New Image;
            $newHouseImages->house_info_id = $newHouseInfo->id;
            $newHouseImages->url = $pathUrl;
            $newHouseImages->save();
           }
        }       


        // if(in_array("url", $data)) {
        //     foreach ($data["url"] as $key => $urlImage) {

        //         dd($urlImage);
        //         // Salvare le immagini in public/storage
        //         $filename_original = $urlImage->getClientOriginalName();
        //         $pathUrl = Storage::disk('public')->putFileAs('images', $urlImage, $filename_original);
                
        //         $newHouseImages = New Image;
        //         $newHouseImages->houses_info_id = $newHouseInfo->id;
        //         $newHouseImages->url = $pathUrl;
        //         $newHouseImages->save();
        //     }
        // }




        // Mail::to($newpost->user->email)->send(new PostedMail($newpost));

        return redirect()->route("host/house.show", $newHouse->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::where('id', $id)->first();

        return view("host/house.show", compact("house"));
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
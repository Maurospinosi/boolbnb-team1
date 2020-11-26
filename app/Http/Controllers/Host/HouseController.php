<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Mail\SendNewMail;

use App\House;
use App\HouseInfo;
use App\Image;
use App\Service;
<<<<<<< HEAD
use App\Http\Controllers\Host\DB;
=======
use App\Tag;
>>>>>>> main

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
        $tags = Tag::all();

        return view ("host/house/create", compact("services", "tags"));
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
        // dd($request->file('url'));

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

        // validazione delle immagini custom
        if (isset($data['url'])) {
            $allowedfileExtension=['jpeg','jpg','png','gif','svg'];
            $images = $request->file('url');

            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if($check == false) {
                    return redirect()->route('host/house.create')
                                    ->withErrors('Formato immagine di ' . $filename . ' non consentito')
                                    ->withInput();                
                } 
            }
        }
   
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

        // Associazione servizi alla casa nella pivot
        if(isset($data['services'])) {
            $services = [];
            foreach($data['services'] as $service) {
                if ($service != "null") {
                    $services[] = $service;
                }
                $newHouse->services()->sync($services);
            }
        }

        // Associazione tags alla casa nella pivot
        if(isset($data['tags'])) {
            $tags = [];
            foreach($data['tags'] as $tag) {
                if ($tag != "null") {
                    $tags[] = $tag;
                }
                $newHouse->tags()->sync($tags);
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
            $newHouseImages->houses_info_id = $newHouseInfo->id;
            $newHouseImages->url = $pathUrl;
            $newHouseImages->save();
           }
        }       

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
        $images = Image::where('houses_info_id', $house->houseinfo->id)->get();

        return view("host/house.show", compact("house", "images"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $house = House::where("id", $id)->first();
        $services = Service::all();
        $tags = Tag::all();

        return view("host.house.edit", compact("house", "services", "tags"));
=======
        $services = Service::all();

        $house = House::where("id", $id)->first();
        return view("host.house.edit", compact("house", "services"));

>>>>>>> main
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
        $data = $request->all();
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
            "url" => "image",
        ]);
            $house = House::findOrFail($id);
            $house -> title = $data['title'];
            $house -> description = $data['description'];
            $house -> rooms = $data['rooms'];
            $house -> beds = $data['beds'];
            $house -> bathrooms = $data['bathrooms'];
            $house -> mq = $data['mq'];
            $house -> address = $data['address'];
            $house -> country = $data['country'];
            $house -> city = $data['city'];
            $house -> zipcode = $data['zipcode'];
            $house -> lat = $data['lat'];
            $house -> lon = $data['lon'];
            $house -> visible = $data['visible'];
            
        $house = House::find($id); 
        $house->user_id = Auth::id();
        
        if(empty($data["services"])) {
            $house->services()->detach();
        } else {
            $house->services()->sync($data["services"]);
        };
       
<<<<<<< HEAD
        $house->save();
        $house->services()->sync($data['services']);
  
        return redirect() -> route("host.house.show", $id)
                          -> withSuccess("Appartamento ".$data["title"]." aggiornato correttamente");
=======
        $house -> save();
        $house -> services() -> sync($data['services']);
  
        return redirect() -> route("host.house.show", $id)
                          -> withSuccess("Appartamento ".$data["title"]
                              ." aggiornato correttamente");
>>>>>>> main
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);
        
        $house->services()->detach();
        $house->tags()->detach();
        
        $house->delete();

        return redirect()->route('host/house.index');
    }
}
<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\House;
use App\HouseInfo;
use App\Image;
use App\Service;
use App\Tag;
use App\Mail\NewHouseAdded;
use Illuminate\Support\Facades\Mail;

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

        return view('host.house.index', compact('houses'));
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

        return view("host/house/create", compact("services", "tags"));
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

        $request->validate([
            "title" => [
                'unique:houses_info',
                'required',
                "max:100",
            ],
            "rooms" => "required",
            "beds" => "required",
            "bathrooms" => "required",
            "mq" => "required",
            "address" => "required|max:100",
            "country" => "required|max:60",
            "region" => "required|max:60",
            "city" => "required|max:60",
            "zipcode" => "required",
            "lat" => "required|max:20",
            "lon" => "required|max:20",
            "price" => "required",
            "cover_image" => "required|image",
        ]);

        // validazione delle immagini custom
        if (isset($data['url'])) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
            $images = $request->file('url');

            foreach ($images as $image) {
                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if ($check == false) {
                    return redirect()->route('host/house.create')
                        ->withErrors('Formato immagine di ' . $filename . ' non consentito')
                        ->withInput();
                }
            }
        }

        // // Salvare l'immagine di copertina in public/storage
        // $filename_original = $data['cover_image']->getClientOriginalName();
        // $uploadedFileUrl = Storage::disk('public')->putFileAs('images', $data['cover_image'], $filename_original);

        $uploadedFileUrl = cloudinary()->upload($request->file('cover_image')->getRealPath())->getSecurePath();


        // Creare una nuova casa
        $newHouse = new House;
        $newHouse->user_id = Auth::id();
        $newHouse->slug = Str::of($data["title"])->slug("-");

        if(isset($data["visible"])) {
            if ($data["visible"] == 0) {
                $newHouse->visible = false;
            } else {
                $newHouse->visible = true;
            }
        }

        $newHouse->save();

        // Associazione servizi alla casa nella pivot
        if (isset($data['services'])) {
            $services = [];
            foreach ($data['services'] as $service) {
                if ($service != "null") {
                    $services[] = $service;
                }
                $newHouse->services()->sync($services);
            }
        }

        // Associazione tags alla casa nella pivot
        if (isset($data['tags'])) {
            $tags = [];
            foreach ($data['tags'] as $tag) {
                if ($tag != "null") {
                    $tags[] = $tag;
                }
                $newHouse->tags()->sync($tags);
            }
        }


        // Creare una nuova HouseInfo
        $newHouseInfo = new HouseInfo;
        $newHouseInfo->house_id = $newHouse->id;
        $newHouseInfo->title = $data['title'];
        $newHouseInfo->description = $data['description'];
        $newHouseInfo->rooms = $data['rooms'];
        $newHouseInfo->beds = $data['beds'];
        $newHouseInfo->bathrooms = $data['bathrooms'];
        $newHouseInfo->mq = $data['mq'];
        $newHouseInfo->address = $data['address'];
        $newHouseInfo->region = $data['region'];
        $newHouseInfo->country = $data['country'];
        $newHouseInfo->city = $data['city'];
        $newHouseInfo->zipcode = $data['zipcode'];
        $newHouseInfo->price = $data['price'];
        $newHouseInfo->cover_image = $uploadedFileUrl;
        $newHouseInfo->lat = $data['lat'];
        $newHouseInfo->lon = $data['lon'];
        $newHouseInfo->save();


        // Se sono presenti immagini aggiuntive, inserirle nella tabella images
        if (isset($data['url'])) {

            foreach ($data["url"] as $urlImage) {

                // Salvare le immagini in public/storage
                $filename_original = $urlImage->getClientOriginalName();
                $pathUrl = Storage::disk('public')->putFileAs('images', $urlImage, $filename_original);

                $newHouseImages = new Image;
                $newHouseImages->houses_info_id = $newHouseInfo->id;
                $newHouseImages->url = $pathUrl;
                $newHouseImages->save();
            }
        }

        // Inviamo la mail all'utente per l'avvenuto salvataggio della casa
        $dati = [
            "user_name" => $newHouse->user->name,
            "user_email" => $newHouse->user->email,
            "title" => $newHouseInfo->title,
            "house_id" => $newHouse->id,
            "price" => $newHouseInfo->price,
            "address" => $newHouseInfo->address,
            "city" => $newHouseInfo->city,
            "cover_image" => $newHouseInfo->cover_image,
            "mq" => $newHouseInfo->mq,
            "rooms" => $newHouseInfo->rooms,
        ];

        Mail::to($dati["user_email"])->send(new NewHouseAdded($dati));

        // Reindirizziamo alla show della nuova casa
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

        $services = Service::all();

        $houseServices = [];

        foreach ($services as $service) {
            if ($house->services->contains($service->id)) {
                $houseServices[] = $service->name;
            }
        }

        if (Auth::id() != $house->user_id) {
            return redirect()->route('guest/house', $house->slug);
        } else {
            return view("host/house.show", compact("house", "images", "services"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::where("id", $id)->first();
        $services = Service::all();
        $tags = Tag::all();

        return view("host.house.edit", compact("house", "services", "tags"));
        $services = Service::all();

        $house = House::where("id", $id)->first();
        return view("host.house.edit", compact("house", "services"));
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
        // dd($data);
        $request->validate([
            "title" => [
                'required',
                "max:100",
                Rule::unique('houses_info', 'title')->ignore($id)
            ],
            "rooms" => "required",
            "beds" => "required",
            "bathrooms" => "required",
            "mq" => "required",
            "address" => "required|max:100",
            "country" => "required|max:60",
            "city" => "required|max:60",
            "zipcode" => "required",
            "lat" => "required|max:20",
            "lon" => "required|max:20",
            "price" => "required",
            "cover_image" => "image",
        ]);

        // Recupero la casa
        $house = House::findOrFail($id);

        $house->slug = Str::of($data["title"])->slug("-");

        if(isset($data["visible"])) {
            if ($data["visible"] == 0) {
                $house->visible = false;
            } else {
                $house->visible = true;
            }
        }
        $house->update();

        // Aggiorno le info della casa
        $house->houseinfo->title = $data['title'];
        $house->houseinfo->description = $data['description'];
        $house->houseinfo->rooms = $data['rooms'];
        $house->houseinfo->beds = $data['beds'];
        $house->houseinfo->bathrooms = $data['bathrooms'];
        $house->houseinfo->mq = $data['mq'];
        $house->houseinfo->address = $data['address'];
        $house->houseinfo->region = $data['region'];
        $house->houseinfo->country = $data['country'];
        $house->houseinfo->city = $data['city'];
        $house->houseinfo->zipcode = $data['zipcode'];
        $house->houseinfo->lat = $data['lat'];
        $house->houseinfo->lon = $data['lon'];
        $house->houseinfo->price = $data['price'];
        $house->houseinfo->update();

        // Aggiorno i servizi
        if (isset($data['services'])) {
            $services = [];
            foreach ($data['services'] as $service) {
                if ($service != "null") {
                    $services[] = $service;
                }
                $house->services()->sync($services);
            }
        } else {
            $house->services()->detach();
        }

        // Aggiorno i tag
        if (isset($data['tags'])) {
            $tags = [];
            foreach ($data['tags'] as $tag) {
                if ($tag != "null") {
                    $tags[] = $tag;
                }
                $house->tags()->sync($tags);
            }
        } else {
            $house->tags()->detach();
        }

        $house->save();
        $house->services()->sync($data['services']);

        // return redirect()->route("host/house.show", $id)
        //     ->withSuccess("Appartamento " . $data["title"] . " aggiornato correttamente");
        // $house->save();
        // $house->services()->sync($data['services']);

        return redirect()->route("host/house.show", $id)
            ->withSuccess("Appartamento aggiornato correttamente");
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
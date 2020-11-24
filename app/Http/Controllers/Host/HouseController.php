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
        return view ("host/house/create ");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            "url" => "image"
        ]);

        $filename_original = $data['cover_image']->getClientOriginalName();
        $pathCover = Storage::disk('public')->putFileAs('images', $data['cover_image'], $filename_original);
       
        $newHouse = New House;
        $newHouse->user_id = Auth::id();
        $newHouse->slug= Str::of($data["title"])->slug("-");
        if ($data["visible"]) {
            $newHouse->visible = true;
        }
        $newHouse->save();


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


        foreach ($data["url"] as $urlImage) {

            $filename_original = $urlImage->getClientOriginalName();
            $pathUrl = Storage::disk('public')->putFileAs('images', $urlImage, $filename_original);
            
            $newHouseImages = New Image;
            $newHouseImages->houses_info_id = $newHouseInfo->id;
            $newHouseImages->url = $pathUrl;
            $newHouseImages->save();
        }


        // Mail::to()
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
        //
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

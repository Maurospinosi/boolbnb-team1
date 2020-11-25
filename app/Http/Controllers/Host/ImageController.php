<?php

namespace App\Http\Controllers\Host;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    //     $input = $request->all();

    //     request()->validate([
    //         'image' => 'required',
    //     ]); 


    //      if($request->hasfile('image')){

            

    //         foreach($request->file('image') as $image) {

    //             $imageName=$image->getClientOriginalName();

    //             $image->move(public_path().'/images/', $imageName);  

    //             $insert['image'] = "$imageName";

    //         }

    //      }       


    //     Image::create($insert);


    //     return back()

    //             ->with('success','Multiple Image Upload Successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}

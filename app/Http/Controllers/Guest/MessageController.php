<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Message;
use App\House;
use App\User;
use App\Mail\NewMessage;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $data = $request->all();

        $request->validate([
            'email' => 'string|required',
            'name' => 'string|required|max:100',
            'message' => 'required'
        ]);

        $newMessage = new Message;
        $newMessage->email = $data['email'];
        $newMessage->guest_name = $data['name'];
        $newMessage->message = $data['message'];
        $newMessage->house_id = $data['house_id'];

        $send = $newMessage->save();

        if (!$send) {
            return redirect()->back()->with('status', 'Messaggio non inviato');
        }

        $house = House::find($data['house_id']);

        $host_email = $house->user->email;

        $dati = [
            "host_name" => $house->user->name,
            "guest_name" => $data['name'],
            "guest_email" => $data['email'],
            "text_message" => $data['message'],
            "title" => $house->houseinfo->title,
            "cover" => $house->houseinfo->cover_image,
            "price" => $house->houseinfo->price,
        ];


        Mail::to($host_email)->send(new NewMessage($dati));

        return redirect()->route('guest/house', $house->slug)->with('status', 'Messaggio inviato');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
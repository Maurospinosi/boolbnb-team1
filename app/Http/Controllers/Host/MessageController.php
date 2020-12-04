<?php

namespace App\Http\Controllers\host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
use App\Message;
use App\House;
use App\User;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house = House::where('user_id' , Auth::id())->get();
        $houseUser = [];
        foreach ($house as $home) {
            array_push($houseUser, $home['id']);
        }
        $messages = Message::whereIn('house_id', $houseUser)->get();
        // $messages = Message::where('house', $house)->get();
        return view ('host.message.index', compact('house', 'houseUser', 'messages'));
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
        $data = $request->all();

        $request->validate([
          'email' => 'string|max:90|required|email',
          'guest_name' => 'string|max:100',
          'message' => 'string|required|min:10|max:700'

        ]);

        $newMessage = new Message;
        $newMessage->email = $data["email"];
        $newMessage->guest_name = $data["guest_name"];
        $newMessage->message = $data["message"];

        $saved = $newMessage->save();
        if (!$saved) {
            return redirect()->back()->with('status', "Il messaggio non è stato inviato");
        }
        Mail::to( $newMessage->user->email)->send(new SendNewMail($newMessage));
        return redirect()->back()->with('status', 'Messaggio inviato');
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
        $message = Message::find($id)->delete();

        return redirect()->route('host/message.index');
    }
}

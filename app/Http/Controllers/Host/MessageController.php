<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\House;
use App\HouseInfo;


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
     //

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
        $message = Message::findORFail($id);
        //controllo per cancellare i messaggi
        $user = Auth::id();
        $entryMessage = $message->house->user_id;
        if ($user != $entryMessage) {
            // abort('404');
            return back()->with('status', 'Non puoi cancellare questo messaggio');
        }
        $message->delete();

    
        return redirect()->route('host/message.index')->with('success', 'Messaggio eliminato con successo!');
    }
}


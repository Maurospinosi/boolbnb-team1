<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\UserInfo;
use App\Mail\NewUser;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // empty
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();

        $user = User::find($user_id);

        return view('host.info.create', ['user_name' => $user['name']]);
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
        $user_id = Auth::id();

        $request->validate([
            "lastname" => "nullable|max:70",
            "date_of_birth" => "nullable|date",
            "gender" => "nullable",
            "city" => "nullable|max:50",
            "picture" => "nullable|image",
        ]);

        $newUserInfo = new UserInfo;
        $newUserInfo->user_id = $user_id;

        if (isset($data['lastname'])) {
            $newUserInfo->lastname = $data['lastname'];
        }

        if (isset($data['date_of_birth'])) {
            $newUserInfo->date_of_birth = $data['date_of_birth'];
        }

        if (isset($data['gender'])) {
            $newUserInfo->gender = $data['gender'];
        }

        if (isset($data['city'])) {
            $newUserInfo->city = $data['city'];
        }

        if (isset($data['picture'])) {

            $filename_original = $data['picture']->getClientOriginalName();
            $pathCover = Storage::disk('public')->putFileAs('images', $data['picture'], $filename_original);

            $newUserInfo->picture = $pathCover;
        }

        $newUserInfo->save();

        $dati = [
            "host_email" => $newUserInfo->user->email,
            "host_name" => $newUserInfo->user->name,
            "birth_date" => $data['date_of_birth'],

        ];

        Mail::to('mail@mail.it')->send(new NewUser($dati));

        return redirect('/');
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
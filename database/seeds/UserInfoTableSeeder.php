<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInfo;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["lastname"=> "Chelaru",
            "date-of-birth"=> "1992-10-08",
            "gender"=> "F",
            "city"=> "Torino",
            "picture"=> "https://picsum.photos/200/300"],
            ["lastname"=> "Cortese",
            "date-of-birth"=> "1994-7-27",
            "gender"=> "F",
            "city"=> "Paola",
            "picture"=> "https://picsum.photos/200/300"],
            ["lastname"=> "Preti",
            "date-of-birth"=> "1986-01-18",
            "gender"=> "M",
            "city"=> "Bologna",
            "picture"=> "https://picsum.photos/200/300"],
            ["lastname"=> "Testi",
            "date-of-birth"=> "1986-10-08",
            "gender"=> "F",
            "city"=> "Faenza",
            "picture"=> "https://picsum.photos/200/300"],
            ["lastname"=> "Spinosi",
            "date-of-birth"=> "1994-3-11",
            "gender"=> "M",
            "city"=> "Napoli",
            "picture"=> "https://picsum.photos/200/300"],
        ];

        $users = User::all();

        $i = 0;

        foreach($users as $user) {
            $newUserInfo = new UserInfo;
            $newUserInfo->user_id = $user->id;
            $newUserInfo->lastname = $data[$i]['lastname'];
            $newUserInfo->date_of_birth = $data[$i]['date-of-birth'];
            $newUserInfo->gender = $data[$i]['gender'];
            $newUserInfo->city = $data[$i]['city'];
            $newUserInfo->picture = $data[$i]['picture'];
            $i++;
            $newUserInfo->save();
        }
    }
}

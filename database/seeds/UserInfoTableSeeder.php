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
            "picture"=> "https://media-exp1.licdn.com/dms/image/C4D03AQFeUg2xgVTYjQ/profile-displayphoto-shrink_400_400/0/1605537316876?e=1613001600&v=beta&t=FgukMrnVu4x-DFkVsWiszqpuv5okXKtMVS29074S6a4"],
            ["lastname"=> "Cortese",
            "date-of-birth"=> "1994-7-27",
            "gender"=> "F",
            "city"=> "Paola",
            "picture"=> "https://media-exp1.licdn.com/dms/image/C5603AQGCTYRYTQxwGA/profile-displayphoto-shrink_400_400/0/1605642253747?e=1613001600&v=beta&t=6AO-S9Vtl8fmzUQpAUW1ZNNCXv79LndgOcDzW4ne768"],
            ["lastname"=> "Preti",
            "date-of-birth"=> "1986-01-18",
            "gender"=> "M",
            "city"=> "Bologna",
            "picture"=> "https://media-exp1.licdn.com/dms/image/C4D03AQGgFAiN01WADQ/profile-displayphoto-shrink_400_400/0/1516776539294?e=1613001600&v=beta&t=n0oRjb76rr5QYtY4T_HYlN1yiwxHQsmcHQG0x0d_pv0"],
            ["lastname"=> "Testi",
            "date-of-birth"=> "1986-10-08",
            "gender"=> "F",
            "city"=> "Faenza",
            "picture"=> "https://media-exp1.licdn.com/dms/image/C4D03AQF0b_Ov0Z48eQ/profile-displayphoto-shrink_400_400/0/1606859632730?e=1613001600&v=beta&t=gSl-S9KCOPMo2_2jx7buWRNiphiGBSoKLKRJeFJ1tI8"],
            ["lastname"=> "Spinosi",
            "date-of-birth"=> "1994-3-11",
            "gender"=> "M",
            "city"=> "Napoli",
            "picture"=> "https://media-exp1.licdn.com/dms/image/C5603AQHMIQcGuTR2ow/profile-displayphoto-shrink_800_800/0/1605984515098?e=1613001600&v=beta&t=q4TdYUmkMapkiqgiEd-7mUztqDC0BdAfuoRyd30bE7Y"],
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

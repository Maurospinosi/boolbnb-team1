<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersNames = [
            "Laura",
            "Federica",
            "Davide",
            "Margherita",
            "Mauro"
        ];

        $usersEmails = [
            "laura@prova.it",
            "federica@prova.it",
            "davide@prova.it",
            "margherita@prova.it",
            "mauro@prova.it",
        ];

        for($i = 0; $i < count($usersNames); $i++) {
            $newUser = new User;
            $newUser->name = $usersNames[$i];
            $newUser->email = $usersEmails[$i];
            $newUser->password = Hash::make("12345678");
            $newUser->save();
        }
    }
}
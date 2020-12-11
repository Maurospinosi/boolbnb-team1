<?php

use Illuminate\Database\Seeder;
use App\House;
use App\Message;

use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $houses = House::all();

        foreach ($houses as $house) {
            $randNumb = rand(20, 40);
            for ($i = 0; $i < $randNumb; $i++) {
                $newMessage = new Message;
                $newMessage->house_id = $house->id;
                $newMessage->guest_name = $faker->name(null);
                $newMessage->email = $faker->freeEmail;
                $newMessage->message = $faker->paragraph(2, true);
                $newMessage->created_at = $faker->dateTimeBetween("-2 years", "now", 'Europe/Paris');
                $newMessage->save();
            }
        }
    }
}
<?php

use Illuminate\Database\Seeder;
use App\House;
use App\User;

class HouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugs = [
            "appartamento-soleggiato",
            "casa-vista-mare",
            "chalet-di-montagna",
            "mansarda-spaziosa",
            "loft-open-space"
        ];

        foreach($slugs as $slug) {
            $randomUser = User::inRandomOrder()->first();

            $newHouse = new House;
            $newHouse->user_id = $randomUser->id;
            $newHouse->slug = $slug;
            $newHouse->visible = rand(0, 1);

            $newHouse->save();
        }
    }
}

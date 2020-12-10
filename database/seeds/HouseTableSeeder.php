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
            "loft-open-space",
            "appartamento-in-centro",
            "casa-tranquilla",
            "isola-privata",
            "buckingham-palace",
            "mansarda-accogliente",
            "posto-letto-in-centro",
            "appartamento-per-studenti",
            "casa-spaziosa",
            "villetta",
            "letto-in-mansarda",
            "enorme-loft-in centro",
            "Appartamento-centrale",
            "Casa-vista-lago",
            "Attico-soleggiato",
            "Ad-un-passo-dal-centro",
            "Palazzo-storico",
            "Enorme-loft",
            "Una perla in città",
            "Un'oasi di pace",
            "Grazioso-mini-appartamento"
        ];

        foreach ($slugs as $slug) {
            $randomUser = User::inRandomOrder()->first();

            $newHouse = new House;
            $newHouse->user_id = $randomUser->id;
            $newHouse->slug = $slug;
            $newHouse->visible = 1;

            $newHouse->save();
        }
    }
}
<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\House;


class HouseServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = House::all();

        foreach($houses as $house) {
            $randomService = Service::inRandomOrder()->limit(rand(1,6))->get();
            $house->services()->sync($randomService);
        }
    }
}

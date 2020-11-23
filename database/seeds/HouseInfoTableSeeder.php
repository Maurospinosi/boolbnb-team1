<?php

use Illuminate\Database\Seeder;
use App\House;
use App\HouseInfo;
use Faker\Generator as Faker;

class HouseInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $houses = House::all();

        foreach($houses as $house) {
            $newHouseInfo = new HouseInfo;
            $newHouseInfo->house_id = $house->id;
            $newHouseInfo->title = $faker->sentence(5, true);
            $newHouseInfo->rooms = rand(1,5);
            $newHouseInfo->beds = rand(1,2);
            $newHouseInfo->bathrooms = rand(1,3);
            $newHouseInfo->mq = rand(30, 80);
            $newHouseInfo->description = $faker->paragraph(3,true);
            $newHouseInfo->address = $faker->streetAddress;
            $newHouseInfo->country = $faker->country;
            $newHouseInfo->city = $faker->city;
            $newHouseInfo->zipcode = rand(10000,99999);
            $newHouseInfo->lat = $faker->latitude;
            $newHouseInfo->lon = $faker->longitude;
            $newHouseInfo->price = $faker->numberBetween(50, 300);
            $newHouseInfo->cover_image = "https://picsum.photos/700/500";
            $newHouseInfo->save();
        }
    }
}

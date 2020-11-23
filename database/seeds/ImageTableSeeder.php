<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\HouseInfo;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $housesInfo = HouseInfo::all();

        foreach($housesInfo as $houseInfo) {
            $randomNr = rand(1,10);
            for($i = 0; $i < $randomNr; $i++) {
                $newImage = new Image;
                $newImage->houses_info_id = $houseInfo->id;
                $newImage->url = "https://www.placecage.com/250/250";
                $newImage->save();
            }
        }
    }
}

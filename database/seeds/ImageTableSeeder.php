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

        $imgArray = [
            "https://loremflickr.com/cache/resized/65535_50549156077_ab4b12ce29_320_240_nofilter.jpg",
            "https://loremflickr.com/cache/resized/3296_3023497361_3f3c9d6c11_320_240_nofilter.jpg",
            "https://loremflickr.com/cache/resized/65535_50692280181_811d77058f_320_240_nofilter.jpg"
        ];

        foreach($housesInfo as $houseInfo) {
            $randomNr = rand(1,10);
            for($i = 0; $i < $randomNr; $i++) {
                $newImage = new Image;
                $newImage->houses_info_id = $houseInfo->id;
                $newImage->url = "https://loremflickr.com/320/240/house";
                $newImage->save();
            }
        }
    }
}
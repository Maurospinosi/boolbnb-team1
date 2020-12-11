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
            "https://i.pinimg.com/originals/89/d6/68/89d668fad60d671526bd3953a39f187b.jpg",
            "https://i.pinimg.com/originals/41/49/0e/41490e9dcdb3d8be156db698893c9ae7.jpg",
            "https://i.pinimg.com/originals/52/9b/d5/529bd53835c8d851f271f2e97745cb3f.jpg",
            "https://i.pinimg.com/originals/b2/25/cd/b225cdf7fc09bcb88672afea46ed57e9.png",
            "https://i.pinimg.com/originals/68/1c/9e/681c9e783db4e62561fdd58304c4bd9d.jpg",
            "https://i.pinimg.com/originals/3c/fd/d7/3cfdd73adc25b9889ec43ea66b4bee20.jpg",
            "https://i.pinimg.com/originals/73/29/22/7329225f3187f7fb340f86582f90b2d5.jpg",
            "https://i.pinimg.com/originals/ea/b4/32/eab4322b4493afb08e1c5c2e915c81bd.jpg",
            "https://i.pinimg.com/originals/e2/a3/23/e2a32373922101f91d78957b4dccbb48.jpg",
            "https://i.pinimg.com/originals/c4/36/44/c43644ede120ab1778d60206c7aa418d.jpg",
            "https://i.pinimg.com/474x/cc/db/87/ccdb8781733a4ca9ce7be24cb8da0128.jpg",
            "https://i.pinimg.com/originals/ac/3a/f6/ac3af68099927aa5314f5403d9da8356.jpg",
            "https://i.pinimg.com/originals/3c/87/57/3c8757186c1eb5d374b82d7087a3038e.jpg",
            "https://i.pinimg.com/originals/a5/0b/d9/a50bd9f0557ed8b8d89df84bbfa7cdf3.jpg",
            "https://i.pinimg.com/originals/8c/0e/90/8c0e90b26d06cc8ee9881058272875d1.jpg",
            "https://i.pinimg.com/600x315/3e/bc/1f/3ebc1f98fa237605b3504d013cf3fcca.jpg",
        ];

        foreach($housesInfo as $houseInfo) {
            $randomNr = rand(1,6);
            for($i = 0; $i < $randomNr; $i++) {
                $randomNr2 = rand(0, (count($imgArray)-1));
                $newImage = new Image;
                $newImage->houses_info_id = $houseInfo->id;
                $newImage->url = $imgArray[$randomNr2];
                $newImage->save();
            }
        }
    }
}
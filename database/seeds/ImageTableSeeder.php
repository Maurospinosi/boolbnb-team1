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
            "https://www.nobroker.in/blog/wp-content/uploads/2020/08/shutterstock_254541790.jpg",
            "https://dramatixdecor.com/wp-content/uploads/2018/01/slide_391840_4774504_free-1200x400.jpg",
            "https://www.conceptualdesigner.in/images/s2.jpg",
            "https://i.pinimg.com/originals/5b/ef/15/5bef153bb23d28a74e6049e34c2e1617.jpg",
            "https://media.decorist.com/designer_hero_images/709-hero-_-cb83086ae6b44feb849a770083367792.jpg",
            "https://obeliskhome.com/wp-content/uploads/2018/06/best-bedroom.jpg",
            "https://www.mightyemu.co.uk/wp-content/uploads/2015/08/oliver-steer-interior-design-kitchen.jpg",
            "https://assets.thehansindia.com/hansindia-bucket/Interiors_1520.jpg?width=500&height=300",
            "https://gray-wbko-prod.cdn.arcpublishing.com/resizer/HxjHI026KU9S9VeR4b1-og8ZanY=/1200x400/smart/cloudfront-us-east-1.images.arcpublishing.com/gray/CSNOC7MEWBLCFJ74CPPDFKHKRA.jpg",
            "https://nyhomeconcept.se/wp-content/uploads/2018/02/Jurmala-1200x400.jpg",
            "https://homesbyhendriks.com/app/uploads/2019/06/Custom-Homes-1200x400.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVBy_SqHN5cxmUxkaWP86TPPk4vgQCroI4ng&usqp=CAU",
            "https://media.decorist.com/designer_hero_images/hero-_-981d7c48709a4c25b8179f850124e653.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpNWdS-2B12Z2P0Ch6mx1TxvbuVj9BtTHCEQ&usqp=CAU",
            "https://g-pulse.com/wordpress/wp-content/uploads/2018/10/weisse-architektur-mm-house-ohlab-hero-slider2-1200x400.jpg",
            "https://jugnionly.com/wp-content/uploads/2019/05/Mirrored-Furniture-1200x400.jpg",
            "https://nyhomeconcept.se/wp-content/uploads/2018/02/AE_Valdemara23A_117-1200x400.jpg",
            "https://mcpvb.com/image/134355720.jpg",
            "https://www.fcilondon.co.uk/site-assets/categories/interior-design/completed-projects/22-wood-mews-big-1.jpg",
            "https://i.pinimg.com/originals/16/c9/3c/16c93c810f4c249b68d7dd55dae9c3dc.jpg",
            "https://www.nobroker.in/blog/wp-content/uploads/2020/05/blog_decor.png"
            // "https://i.pinimg.com/originals/89/d6/68/89d668fad60d671526bd3953a39f187b.jpg",
            // "https://i.pinimg.com/originals/41/49/0e/41490e9dcdb3d8be156db698893c9ae7.jpg",
            // "https://i.pinimg.com/originals/52/9b/d5/529bd53835c8d851f271f2e97745cb3f.jpg",
            // "https://i.pinimg.com/originals/b2/25/cd/b225cdf7fc09bcb88672afea46ed57e9.png",
            // "https://i.pinimg.com/originals/68/1c/9e/681c9e783db4e62561fdd58304c4bd9d.jpg",
            // "https://i.pinimg.com/originals/3c/fd/d7/3cfdd73adc25b9889ec43ea66b4bee20.jpg",
            // "https://i.pinimg.com/originals/73/29/22/7329225f3187f7fb340f86582f90b2d5.jpg",
            // "https://i.pinimg.com/originals/ea/b4/32/eab4322b4493afb08e1c5c2e915c81bd.jpg",
            // "https://i.pinimg.com/originals/e2/a3/23/e2a32373922101f91d78957b4dccbb48.jpg",
            // "https://i.pinimg.com/originals/c4/36/44/c43644ede120ab1778d60206c7aa418d.jpg",
            // "https://i.pinimg.com/474x/cc/db/87/ccdb8781733a4ca9ce7be24cb8da0128.jpg",
            // "https://i.pinimg.com/originals/ac/3a/f6/ac3af68099927aa5314f5403d9da8356.jpg",
            // "https://i.pinimg.com/originals/3c/87/57/3c8757186c1eb5d374b82d7087a3038e.jpg",
            // "https://i.pinimg.com/originals/a5/0b/d9/a50bd9f0557ed8b8d89df84bbfa7cdf3.jpg",
            // "https://i.pinimg.com/originals/8c/0e/90/8c0e90b26d06cc8ee9881058272875d1.jpg",
            // "https://i.pinimg.com/600x315/3e/bc/1f/3ebc1f98fa237605b3504d013cf3fcca.jpg",
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
<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [ 
                'name' => "short",
                'price' => 2.99,
                'duration' => 1
            ],
            [ 
                'name' => "medium",
                'price' => 5.99,
                'duration' => 3
            ],
            [ 
                'name' => "long",
                'price' => 9.99,
                'duration' => 6
            ],
        ];

        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor;
            $newSponsor->name = $sponsor['name'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->duration = $sponsor['duration'];
            $newSponsor->save();
        }
    }
}
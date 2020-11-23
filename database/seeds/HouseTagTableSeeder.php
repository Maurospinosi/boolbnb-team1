<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\House;

class HouseTagTableSeeder extends Seeder
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
            $randomTags = Tag::inRandomOrder()->limit(rand(1,4))->get();
            $house->tags()->sync($randomTags);
        }
    }
}

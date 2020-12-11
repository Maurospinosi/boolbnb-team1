<?php

use Illuminate\Database\Seeder;
use App\House;
use App\View;
use Faker\Generator as Faker;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $houses = House::all();

        foreach ($houses as $house) {
            $randomNr = rand(200, 400);
            for ($i = 0; $i < $randomNr; $i++) {
                $newView = new View;
                $newView->house_id = $house->id;
                $newView->created_at = $faker->dateTimeBetween("-2 years", "now", 'Europe/Paris');
                $newView->save();
            }
        }
    }
}
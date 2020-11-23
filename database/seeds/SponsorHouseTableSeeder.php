<?php

use Illuminate\Database\Seeder;
use App\House;
use App\Sponsor;
use Faker\Generator as Faker;
use Carbon\Carbon;

class SponsorHouseTableSeeder extends Seeder
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
            $rand = rand(0,1);

            if ($rand == 1) {                
                $randomSponsor = Sponsor::inRandomOrder()->first();
                // dd($house);
                // dd($randomSponsor);

                // $randomSponsor["start_date"] =  "1990-02-02";
                // $randomSponsor["end_date"] =  "1990-02-02";

                // dd($randomSponsor);
                // dd($house->sponsors()->sync($randomSponsor));

                // $house->sponsors()->attach($randomSponsor, ['start_date' => "1990-02-02", 'end_date' => $faker->date()]);

                $now = Carbon::now();
                $end = Carbon::now()->addDays($randomSponsor->duration);

                $house->sponsors()->attach($randomSponsor, ['start_date' =>$now, 'end_date' => $end]);

            }
        }
    }
}
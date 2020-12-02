<?php

use Illuminate\Database\Seeder;
use App\House;
use App\HouseInfo;
use Faker\Generator as Faker;

class HouseObj {
    // Vie reali
    public $address;
    public $region;
    public $zipcode;
    public $city;
    public $country;
    public $lat;
    public $lon;

    // Costruttore
    public function __construct($address, $region, $zipcode, $city, $country, $lat, $lon){

        $this->address = $address;
        $this->region = $region;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->country = $country;
        $this->lat = $lat;
        $this->lon = $lon;
    }
}

class HouseInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $houseArr = [];

        // Bologna
        $house1 = new HouseObj('via castellata', 'Emilia Romagna', 400124, 'Bologna', 'Italia', 44.4885, 11.3487);
        $houseArr[] = $house1;

        $house2 = new HouseObj("Via dell'Indipendenza", 'Emilia Romagna', 400126, 'Bologna', 'Italia', 44.5006, 11.3442);
        $houseArr[] = $house2;

        $house2a = new HouseObj("Via Properzia De' Rossi", 'Emilia Romagna', 40138, 'Bologna', 'Italia', 44.4919, 11.4179);
        $houseArr[] = $house2a;

        $house2b = new HouseObj("Via delle Fonti 29", 'Emilia Romagna', 40128, 'Bologna', 'Italia', 44.5462, 11.3540);
        $houseArr[] = $house2b;

        // Firenze
        $house3 = new HouseObj("Piazza del Duomo", 'Toscana', 50122, 'Firenze', 'Italia', 43.773, 11.2565);
        $houseArr[] = $house3;

        $house4 = new HouseObj("Piazza del Carmine 4", 'Toscana', 50123, 'Firenze', 'Italia', 43.7685, 11.2443);
        $houseArr[] = $house4;

        // Torino
        $house5 = new HouseObj("Corso Unità d'Italia 40", "Piemonte", 10126, "Torino", "Torino", 45.0278, 7.67228);
        $houseArr[] = $house5;

        $house6 = new HouseObj("Via Paolo Borsellino 3", "Piemonte", 10138, "Torino", "Italia", 45.0661, 7.65728);
        $houseArr[] = $house6;

        // Napoli
        $house7 = new HouseObj("Piazza Giuseppe Garibaldi 91", "Campania", 80142, "Napoli", "Italia", 40.8524, 14.2695);
        $houseArr[] = $house7;

        $house8 = new HouseObj("Via Frediano Cavara 12", "Campania", 80139, "Napoli", "Italia", 40.8581, 14.2618);
        $houseArr[] = $house8;

        // Bari
        $house9 = new HouseObj("Piazza Giulio Cesare 11", "Puglia", 70124, "Bari", "Italia", 41.1121, 16.8623);
        $houseArr[] = $house9;

        $house10 = new HouseObj("Via Pier L'Eremita 25", "Puglia", 70122, "Bari", "Italia", 41.1314, 16.8688);
        $houseArr[] = $house10;

        // Milano
        $house11 = new HouseObj("Piazza del Duomo", "Lombardia", 2021, "Milano", "Italia", 45.4642, 9.19069);
        $houseArr[] = $house11;

        $house12 = new HouseObj("Via Enrico Besana 12", "Lombardia", 20122, "Milano", "Italia", 45.4606, 9.20489);
        $houseArr[] = $house12;

        // Catania
        $house13 = new HouseObj("Via Juvara 9", "Sicilia", 95122, "Catania", "Italia", 37.4976, 15.078);
        $houseArr[] = $house13;

        $house14 = new HouseObj("Via Etnea 502", "Sicilia", 95128, "Catania", "Italia", 37.5144, 15.0845);
        $houseArr[] = $house14;
        
        
        $houses = House::all();
        $i = 0;
        // dd($houseArr[$i]->address);
        
        foreach($houses as $house) {

            $newHouseInfo = new HouseInfo;

            $newHouseInfo->house_id = $house->id;
            $newHouseInfo->title = str_replace("-", " ", $house->slug);
            $newHouseInfo->rooms = rand(1,5);
            $newHouseInfo->beds = rand(1,2);
            $newHouseInfo->bathrooms = rand(1,3);
            $newHouseInfo->mq = rand(30, 80);
            $newHouseInfo->description = $faker->paragraph(3,true);
            $newHouseInfo->address = $houseArr[$i]->address;
            $newHouseInfo->region = $houseArr[$i]->region;
            $newHouseInfo->zipcode = $houseArr[$i]->zipcode;
            $newHouseInfo->city = $houseArr[$i]->city;
            $newHouseInfo->country = $houseArr[$i]->country;
            $newHouseInfo->lat = $houseArr[$i]->lat;
            $newHouseInfo->lon = $houseArr[$i]->lon;
            $newHouseInfo->price = $faker->numberBetween(50, 300);
            $newHouseInfo->cover_image = "https://picsum.photos/700/500";
            $newHouseInfo->save();
            $i++;
        }
    }

    //     foreach($houses as $house) {
    //         $newHouseInfo = new HouseInfo;
    //         $newHouseInfo->house_id = $house->id;
    //         $newHouseInfo->title = $faker->sentence(5, true);
    //         $newHouseInfo->rooms = rand(1,5);
    //         $newHouseInfo->beds = rand(1,2);
    //         $newHouseInfo->bathrooms = rand(1,3);
    //         $newHouseInfo->mq = rand(30, 80);
    //         $newHouseInfo->description = $faker->paragraph(3,true);
    //         $newHouseInfo->address = $faker->streetAddress;
    //         $newHouseInfo->region = "Piemonte";
    //         $newHouseInfo->zipcode = rand(10000,99999);
    //         $newHouseInfo->city = $faker->city;
    //         $newHouseInfo->country = $faker->country;
    //         $newHouseInfo->lat = $faker->latitude;
    //         $newHouseInfo->lon = $faker->longitude;
    //         $newHouseInfo->price = $faker->numberBetween(50, 300);
    //         $newHouseInfo->cover_image = "https://picsum.photos/700/500";
    //         $newHouseInfo->save();
    //     }
    // }
}
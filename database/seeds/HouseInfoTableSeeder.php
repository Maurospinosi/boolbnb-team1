<?php

use Illuminate\Database\Seeder;
use App\House;
use App\HouseInfo;
use Faker\Generator as Faker;

class HouseObj
{
    // Vie reali
    public $address;
    public $region;
    public $zipcode;
    public $city;
    public $country;
    public $lat;
    public $lon;

    // Costruttore
    public function __construct($address, $region, $zipcode, $city, $country, $lat, $lon)
    {

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

        $house2c = new HouseObj("Via Paolo Bentivoglio 8", 'Emilia Romagna', 40133, 'Bologna', 'Italia', 44.4913, 11.2965);
        $houseArr[] = $house2c;

        $house2d = new HouseObj("Via Antonio Cavalieri Ducati 3", 'Emilia Romagna', 40132, 'Bologna', 'Italia', 44.515, 11.2565);
        $houseArr[] = $house2d;

        $house2e = new HouseObj("Via Vittorio Peglion 25", 'Emilia Romagna', 40013, 'Bologna', 'Italia', 44.5474, 11.3708);
        $houseArr[] = $house2e;

        $house2f = new HouseObj("Via 2 Agosto 1980", 'Emilia Romagna', 40053, 'Valsamoggia', 'Italia', 44.5139, 11.1681);
        $houseArr[] = $house2f;

        $house2g = new HouseObj("Via Lavino 181", 'Emilia Romagna', 40050, 'Monte San Pietro', 'Italia', 44.4191, 11.1721);
        $houseArr[] = $house2g;

        $house2h = new HouseObj("Via Emilia 3", 'Emilia Romagna', 40064, 'Bologna', 'Italia', 44.4415, 11.4852);
        $houseArr[] = $house2h;

        $house2i = new HouseObj("Via Aspromonte 19", 'Emilia Romagna', 40026, 'Bologna', 'Italia', 44.3578, 11.7149);
        $houseArr[] = $house2i;

        $house2l = new HouseObj("Via Monte del Re 43", 'Emilia Romagna', 40060, 'Dozza', 'Italia', 44.3582, 11.6099);
        $houseArr[] = $house2l;

        $house2i = new HouseObj("Via Risorgimento 20", 'Emilia Romagna', 40068, 'Bologna', 'Italia', 44.4648, 11.409);
        $houseArr[] = $house2i;

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

        // Savona
        $house15 = new HouseObj("Via Cirano Bellotto 12", "Liguria", 17047, "Savona", "Italia", 44.283326, 8.427920);
        $houseArr[] = $house15;


        $imgArray = [
            "https://a0.muscache.com/im/pictures/774f0e59-92c5-4707-bc75-779bcd0acd76.jpg",
            "https://a0.muscache.com/im/pictures/9fe3d989-0825-475b-b1ef-8b0d176a9e6f.jpg",
            "https://a0.muscache.com/im/pictures/3082129e-ba80-4f24-a1cf-9e8c77581cd8.jpg",
            "https://a0.muscache.com/im/pictures/87a08fea-8ee7-4d0d-86e6-945c9a971b0f.jpg",
            "https://a0.muscache.com/im/pictures/aaae6c30-8b7a-4e16-8888-d2b09e697bdd.jpg",
            "https://a0.muscache.com/im/pictures/2f3e465a-b581-4eaa-b911-1e719ad06d83.jpg",
            "https://a0.muscache.com/im/pictures/33af1d13-2aab-4a3c-8825-f6ed4feb7c48.jpg",
            "https://a0.muscache.com/im/pictures/23da5b49-7f32-4270-a2d9-2cfbf28b9739.jpg",
            "https://a0.muscache.com/im/pictures/ad7ed221-d133-436c-9da7-8619c3ea340b.jpg",
            "https://a0.muscache.com/im/pictures/c3a24575-56f1-45c1-bdfa-bda8e6ad1e23.jpg",
            "https://a0.muscache.com/im/pictures/86983639/ec0407b9_original.jpg",
            "https://a0.muscache.com/im/pictures/86984586/be197de9_original.jpg",
            "https://a0.muscache.com/im/pictures/ba1f2c3b-6378-46b4-8d70-cf2a87719d2b.jpg",
            "https://a0.muscache.com/im/pictures/c3a24575-56f1-45c1-bdfa-bda8e6ad1e23.jpg",
            "https://a0.muscache.com/im/pictures/17c14883-5108-4773-b649-744146113bf1.jpg",
            "https://a0.muscache.com/im/pictures/4addd333-2e76-4103-8083-1dec61ce2814.jpg",
            "https://a0.muscache.com/im/pictures/0c691e7e-b872-4088-b553-b6280e1776f3.jpg",
            "https://a0.muscache.com/im/pictures/cdfa9dd7-0a87-467d-9606-c8842675faab.jpg",
            "https://a0.muscache.com/im/pictures/b8e6a02c-5736-4b54-86d1-84a2bea32cab.jpg",
            "https://a0.muscache.com/im/pictures/852eac02-1f54-46c0-95bd-04d6ac48f623.jpg",
            "https://a0.muscache.com/im/pictures/5037a00f-0808-4724-bc8d-ad8ab852aae2.jpg",
            "https://a0.muscache.com/im/pictures/b0eb2867-c3aa-4a5b-9984-3667d8112e23.jpg",
            "https://a0.muscache.com/im/pictures/b772ce62-321c-4251-a997-3f380c57b44e.jpg",
            "https://a0.muscache.com/im/pictures/607b3067-2e14-4329-9a6d-8cf816f591ea.jpg",
            "https://a0.muscache.com/im/pictures/c41a4e04-0fea-4e45-ae68-f13f1b2af885.jpg",
            "https://a0.muscache.com/im/pictures/0fb2ad55-974c-4245-aa0b-b082deb27ddf.jpg"
        ];


        $houses = House::all();

        $i = 0;

        foreach ($houses as $house) {

            $newHouseInfo = new HouseInfo;

            $newHouseInfo->house_id = $house->id;
            $newHouseInfo->title = str_replace("-", " ", $house->slug);
            $newHouseInfo->rooms = rand(1, 5);
            $newHouseInfo->beds = rand(1, 2);
            $newHouseInfo->bathrooms = rand(1, 3);
            $newHouseInfo->mq = rand(30, 150);
            $newHouseInfo->description = "Grazioso e moderno appartamento di circa 50 mq, al primo piano (senza ascensore, 28 scalini) di una bella palazzina residenziale che sorge in una tranquilla via privata nelle immediate adiacenze del quartiere del Pratello, famoso per il fermento artistico ed intellettuale che lo rendono un luogo unico.";
            $newHouseInfo->address = $houseArr[$i]->address;
            $newHouseInfo->region = $houseArr[$i]->region;
            $newHouseInfo->zipcode = $houseArr[$i]->zipcode;
            $newHouseInfo->city = $houseArr[$i]->city;
            $newHouseInfo->country = $houseArr[$i]->country;
            $newHouseInfo->lat = $houseArr[$i]->lat;
            $newHouseInfo->lon = $houseArr[$i]->lon;
            $newHouseInfo->price = $faker->numberBetween(50, 300);
            $newHouseInfo->cover_image = $imgArray[$i];
            $newHouseInfo->save();

            $i++;
        }
    }
}
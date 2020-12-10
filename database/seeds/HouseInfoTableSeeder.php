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
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613689/ad7ed221-d133-436c-9da7-8619c3ea340b_d7lbuv.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613679/23da5b49-7f32-4270-a2d9-2cfbf28b9739_jyjjyw.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613667/33af1d13-2aab-4a3c-8825-f6ed4feb7c48_o3w7ei.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613657/2f3e465a-b581-4eaa-b911-1e719ad06d83_nn5egv.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613643/aaae6c30-8b7a-4e16-8888-d2b09e697bdd_cjolyz.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613634/87a08fea-8ee7-4d0d-86e6-945c9a971b0f_csbdm2.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613622/3082129e-ba80-4f24-a1cf-9e8c77581cd8_zgdj3z.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613611/9fe3d989-0825-475b-b1ef-8b0d176a9e6f_dkakd8.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613592/774f0e59-92c5-4707-bc75-779bcd0acd76_zirswk.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614089/c41a4e04-0fea-4e45-ae68-f13f1b2af885_qtuutu.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614158/3385fff1-0b52-4072-9ee5-700f88386efd_nzeakn.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614190/2af953e8-ec22-436b-92f5-1d8500b0fbaa_bimsqo.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614230/442ba769-ff4e-4102-9331-9f79436136af_oornuk.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614306/f8340f0c-85d0-4550-bd06-a4e390db3b98_y8gwfo.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614345/02b9100f-faa1-4c93-94d6-eb67b04a358d_rrzjic.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614397/cd3d21b1-99e9-4ed6-b9ee-1aa2b914c2c1_kah80i.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614459/e2ccfa38-2daf-4887-998a-c6a1e5662719_xa91bz.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614495/ed85318f-79f5-4124-809d-5c460e38e472_ilf653.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614618/224c0485-3694-44ae-9eab-0596f9954007_sf727f.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614663/7fa46f5e-d967-4415-910e-aeed646e0191_yeu4xu.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614696/d0427a97-8a78-406a-8357-2dc507a4f2a7_xggqlg.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614750/0722002a-c300-4587-b7a4-02921de7e51a_otzvft.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614860/8609dc76-be43-4252-be34-ffb74ef82e0b_dce1hl.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607614916/55bbbcd2-2731-4786-ac10-a2bad7efeaae_zb9e6t.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607615027/c0627892-e1ba-4f45-8865-fab86b7de4bc_azlrkl.jpg",
            "https://res.cloudinary.com/dofcj4o0y/image/upload/v1607613667/33af1d13-2aab-4a3c-8825-f6ed4feb7c48_o3w7ei.jpg"
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
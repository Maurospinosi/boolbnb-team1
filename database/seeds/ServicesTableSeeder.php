<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            "wi-fi",
            "parking",
            "swimming pool",
            "reception",
            "sauna",
            "see view"
        ];

        foreach($services as $service) {
            $newService = new Service;
            $newService->name = $service;
            $newService->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            UserInfoTableSeeder::class,
            HouseTableSeeder::class,
            HouseInfoTableSeeder::class,
            ImageTableSeeder::class,
            TagTableSeeder::class,
            HouseTagTableSeeder::class,
            ServicesTableSeeder::class,
            HouseServiceTableSeeder::class,
            MessagesTableSeeder::class,
            SponsorsTableSeeder::class,
            SponsorHouseTableSeeder::class,
            ViewsTableSeeder::class
            ]);
    }
}
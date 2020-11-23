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
        $this->call(UsersTableSeeder::class);
        $this->call(UserInfoTableSeeder::class);
        $this->call(HouseTableSeeder::class);
        $this->call(HouseInfoTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(HouseTagTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(HouseServiceTableSeeder::class);
    }
}

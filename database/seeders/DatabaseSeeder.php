<?php

 namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\BloodSeeder;
use Database\Seeders\ReligionsSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\NationalitiesSeeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\SpecializationSeeder ;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(ReligionsSeeder::class);
        $this->call(NationalitiesSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SpecializationSeeder ::class);
    }
}

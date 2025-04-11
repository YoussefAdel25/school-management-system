<?php

 namespace Database\Seeders;


use Database\Seeders\BloodSeeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\NationalitiesSeeder;
use Database\Seeders\ReligionsSeeder;
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
        $this->call(CreateAdminUserSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(ReligionsSeeder::class);

        $this->call(NationalitiesSeeder::class);
    }
}

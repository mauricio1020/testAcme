<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Driver;
use App\Models\Owner;
use App\Models\User;
use App\Models\Vehicle;
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
        User::factory(1)->create();
        Vehicle::factory(5)->create();
        Driver::factory(5)->create();
        Owner::factory(5)->create();


    }
}

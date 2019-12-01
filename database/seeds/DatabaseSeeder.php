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
        $this->call(CitySeeder::class);
        $this->call(TransitSeeder::class);
        $this->call(TourSeeder::class);
        $this->call(ItinerarySeeder::class);
        $this->call(RouteSeeder::class);
        $this->call(TripSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(UserSeeder::class);
    }
}

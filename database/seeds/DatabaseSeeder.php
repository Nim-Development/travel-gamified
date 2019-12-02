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

        // $this->call(GameQuizSeeder::class);
        $this->call(GameTextAnswereSeeder::class);
        $this->call(GameMediaUploadSeeder::class);
        $this->call(GameMultipleChoiceSeeder::class);
        $this->call(GameMultipleChoiceOptionSeeder::class);
        $this->call(ChallengeSeeder::class);
        $this->call(AnswereCheckedSeeder::class);
        $this->call(AnswereUncheckedSeeder::class);

    }
}

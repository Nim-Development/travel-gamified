<?php

use Illuminate\Database\Seeder;

class GameMultipleChoiceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GameMultipleChoiceOption::class, 120)->create();
    }
}

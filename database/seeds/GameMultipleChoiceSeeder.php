<?php

use Illuminate\Database\Seeder;

class GameMultipleChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Games\GameMultipleChoice::class, 30)->create();
    }
}

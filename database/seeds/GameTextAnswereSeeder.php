<?php

use Illuminate\Database\Seeder;

class GameTextAnswereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GameTextAnswere::class, 30)->create();
    }
}

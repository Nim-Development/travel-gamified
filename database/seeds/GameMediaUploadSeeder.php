<?php

use Illuminate\Database\Seeder;

class GameMediaUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Games\GameMediaUpload::class, 30)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class AnswereCheckedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AnswereChecked::class, 46)->create();
    }
}

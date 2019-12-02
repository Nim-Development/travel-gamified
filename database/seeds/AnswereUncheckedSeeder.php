<?php

use Illuminate\Database\Seeder;

class AnswereUncheckedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AnswereUnchecked::class, 31)->create();
    }
}

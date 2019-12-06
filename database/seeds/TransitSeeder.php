<?php
use Illuminate\Database\Seeder;

class TransitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Playfields\Transit::class, 19)->create();

    }
}

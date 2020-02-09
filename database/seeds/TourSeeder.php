<?php
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playfield_types = ['city', 'transit', 'city', 'route', 'city'];

        factory(App\Tour::class, 5)->create()->each(function ($tour) use ($playfield_types) {
            foreach($playfield_types as $step => $type){
                $tour->itineraries()->save(factory(App\Itinerary::class)->create([
                    'step' => $step,
                    'playfield_type' => $type,
                    'playfield_id' => $step+3
                ]));
            }
        });
    }
}
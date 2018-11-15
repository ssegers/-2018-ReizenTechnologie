<?php

use Illuminate\Database\Seeder;

class HotelsPerTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hotels_per__trip')->insert(array(
            'hotel_id' => 1,
            'trip_id' => 1,
        ));
        DB::table('hotels_per__trip')->insert(array(
            'hotel_id' => 2,
            'trip_id' => 1,
        ));
        DB::table('hotels_per__trip')->insert(array(
            'hotel_id' => 3,
            'trip_id' => 2,
        ));
    }
}

<?php

use Illuminate\Database\Seeder;

class RoomsPerHotelPerTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rooms_per_hotel_per_trip')->insert(array(
            'hotels_per_trip_id' => 1,
            'size' => 4,
        ));
        DB::table('rooms_per_hotel_per_trip')->insert(array(
            'hotels_per_trip_id' => 1,
            'size' => 4,
            ));
        DB::table('rooms_per_hotel_per_trip')->insert(array(
            'hotels_per_trip_id' => 2,
            'size' => 4,
        ));
    }
}

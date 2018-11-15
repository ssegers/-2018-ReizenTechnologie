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
            'hotel_id' => 1,
            'room_id' => 1,
        ));
        DB::table('rooms_per_hotel_per_trip')->insert(array(
            'hotel_id' => 1,
            'room_id' => 2,
        ));
        DB::table('rooms_per__hotels')->insert(array(
            'hotel_id' => 2,
            'room_id' => 3,
        ));
    }
}

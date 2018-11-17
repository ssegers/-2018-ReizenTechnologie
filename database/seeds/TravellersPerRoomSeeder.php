<?php

use Illuminate\Database\Seeder;

class TravellersPerRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travellers_per_rooms')->insert(array(
            'traveller_id' => 1,
            'rooms_hotel_trip_id' => 1,
        ));
        DB::table('travellers_per_rooms')->insert(array(
            'traveller_id' => 2,
            'rooms_hotel_trip_id' => 1,
        ));
        DB::table('travellers_per_rooms')->insert(array(
            'traveller_id' => 3,
            'rooms_hotel_trip_id' => 1,
        ));

    }
}

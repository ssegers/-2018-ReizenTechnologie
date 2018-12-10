<?php

use Illuminate\Database\Seeder;

class TravellersPerTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //koppel Mr. Segers aan Amerika
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 1,
            'is_guide' => true,
            'is_organizer' => true,
        ]);
        //koppel Mr. Segers aan Duitsland
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 1,
            'is_organizer' => true,
        ]);
        //koppel Mr. Rudi aan Amerika
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 2,
            'is_organizer' => true,
        ]);
        //koppel Mr. Roox aan Duitsland
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 2,
            'is_guide' => true,
            'is_organizer' => false,
        ]);

        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 3,
            'is_organizer' => false,
        ]);

        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 4,
            'is_organizer' => false,
        ]);

        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 5,
            'is_organizer' => false,
        ]);
/******/
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 6,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 7,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 8,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 9,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 10,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 11,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 12,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 13,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 14,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 15,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 16,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 17,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 18,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 19,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 20,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 21,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 22,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 23,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 24,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 25,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 26,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 27,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 28,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 29,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 30,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 31,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 32,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 33,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 34,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 35,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 36,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 37,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 38,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 39,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 40,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 41,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 42,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 43,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 44,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 45,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 46,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 47,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 48,
            'is_organizer' => false,
        ]);
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 49,
            'is_organizer' => false,
        ]);
    }
}

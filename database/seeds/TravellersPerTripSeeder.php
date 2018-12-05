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
            'is_organizer' => true,
        ]);
        //koppel Mr. Rudi aan Amerika
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 1,
            'traveller_id' => 2,
            'is_organizer' => true,
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

        //koppel Mr. Roox aan Duitsland
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 2,
            'is_organizer' => false,
        ]);

        //koppel Mr. Segers aan Duitsland
        DB::table('travellers_per_trips')->insert([
            'trip_id' => 2,
            'traveller_id' => 1,
            'is_organizer' => false,
        ]);
    }
}

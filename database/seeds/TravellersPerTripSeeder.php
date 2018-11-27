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
        DB::table('travellers_per_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 1,
        ]);

        //koppel Mr. Roox aan Duitsland
        DB::table('travellers_per_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 2,
        ]);

        //koppel Mr. Segers aan Duitsland
        DB::table('travellers_per_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 1,
        ]);
    }

}

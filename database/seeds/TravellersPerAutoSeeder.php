<?php

use Illuminate\Database\Seeder;

class TravellersPerAutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travellers_per_autos')->insert(array(
            'traveller_id' => 1,
            'autos_per_trip_id' => 1,
        ));
        DB::table('travellers_per_autos')->insert(array(
            'traveller_id' => 2,
            'autos_per_trip_id' => 1,
        ));
        DB::table('travellers_per_autos')->insert(array(
            'traveller_id' => 3,
            'autos_per_trip_id' => 1,
        ));

    }
}

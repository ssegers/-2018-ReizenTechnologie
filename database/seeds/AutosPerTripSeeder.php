<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AutosPerTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('autos_per_trips')->insert(array(
            'auto_id' => 1,
            'trip_id' => 1,
        ));
        DB::table('autos_per_trips')->insert(array(
            'auto_id' => 2,
            'trip_id' => 1,
        ));
        DB::table('autos_per_trips')->insert(array(
            'auto_id' => 3,
            'trip_id' => 2,
        ));
    }
}

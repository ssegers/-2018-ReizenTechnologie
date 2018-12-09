<?php

use Carbon\Carbon;
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
        DB::table('hotels_per_trips')->insert(array(
            'hotel_id' => 1,
            'trip_id' => 1,
            'hotel_start_date'=>Carbon::create('2018', '12', '15'),
            'hotel_end_date'=>Carbon::create('2018', '12', '16')
        ));
        DB::table('hotels_per_trips')->insert(array(
            'hotel_id' => 2,
            'trip_id' => 1,
            'hotel_start_date'=>Carbon::create('2018', '12', '16'),
            'hotel_end_date'=>Carbon::create('2018', '12', '19')

        ));
        DB::table('hotels_per_trips')->insert(array(
            'hotel_id' => 3,
            'trip_id' => 2,
            'hotel_start_date'=>Carbon::create('2018', '12', '19'),
            'hotel_end_date'=>Carbon::create('2018', '12', '20')
        ));
    }
}

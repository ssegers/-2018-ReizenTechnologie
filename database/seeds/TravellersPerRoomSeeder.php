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
        DB::table('travellers_per__rooms')->insert(array(
            'traveller_id' => 1,
            'room_id' => 1,
        ));
        DB::table('travellers_per__rooms')->insert(array(
            'traveller_id' => 2,
            'room_id' => 1,
        ));
        DB::table('travellers_per__rooms')->insert(array(
            'traveller_id' => 3,
            'room_id' => 1,
        ));

    }
}

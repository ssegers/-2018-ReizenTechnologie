<?php

use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_1',
            'address' => 'address1',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_2',
            'address' => 'address2',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_3',
            'address' => 'address3',
        ));
    }
}

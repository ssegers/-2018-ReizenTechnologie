<?php

use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rooms')->insert(array(
            'number_of_beds' => 4,
        ));

        DB::table('rooms')->insert(array(
            'number_of_beds' => 4,
        ));

        DB::table('rooms')->insert(array(
            'number_of_beds' => 4,
        ));


    }
}

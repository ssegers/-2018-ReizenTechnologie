<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            'name' => 'Amerika',
            'is_active' => true,
            'year' => 2019,
            'contact_mail'=>'kaan.akpinar@hotmail.com'
        ]);

        DB::table('trips')->insert([
            'name' => 'Duitsland',
            'is_active' => true,
            'year' => 2019
        ]);

        DB::table('trips')->insert([
            'name' => 'Amerika',
            'is_active' => false,
            'year' => 2018
        ]);
    }
}

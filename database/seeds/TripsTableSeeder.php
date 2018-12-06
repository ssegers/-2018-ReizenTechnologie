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
            'price'=>2000,
            'contact_mail'=>'kaan.akpinar@hotmail.com'
        ]);

        DB::table('trips')->insert([
            'name' => 'Duitsland',
            'is_active' => true,
            'price'=>1000,
            'year' => 2019,
            'contact_mail'=>'kaan.akpinar@hotmail.com'
        ]);

        DB::table('trips')->insert([
            'name' => 'Amerika',
            'is_active' => false,
            'price'=>1999,
            'year' => 2018,
            'contact_mail'=>'kaan.akpinar@hotmail.com'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ZipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zips')->insert([
            'zip_code' => '3590',
            'city' => 'Diepenbeek'
        ]);


        DB::table('zips')->insert([
            'zip_code' => '3670',
            'city' => 'Oudsbergen'
        ]);


        DB::table('zips')->insert([
            'zip_code' => '3630',
            'city' => 'Maasmechelen'
        ]);


        DB::table('zips')->insert([
            'zip_code' => '3600',
            'city' => 'Genk'
        ]);


        DB::table('zips')->insert([
            'zip_code' => '3500',
            'city' => 'Hasselt'
        ]);
    }
}

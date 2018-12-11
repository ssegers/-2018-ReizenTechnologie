<?php

use Illuminate\Database\Seeder;

class AutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('autos')->insert(array(
            'auto_name' => 'auto_1',
            'size' => '3',
        ));

        DB::table('autos')->insert(array(
            'auto_name' => 'auto_2',
            'size' => '4',
        ));

        DB::table('autos')->insert(array(
            'auto_name' => 'auto_3',
            'size' => '5',
        ));
    }
}

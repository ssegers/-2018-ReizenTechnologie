<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //id = 1
        DB::table('majors')->insert(array(
            'study_id' => 1,
            'major_name' => "ICT"
        ));
        //id = 2
        DB::table('majors')->insert(array(

            'study_id' => 1,
            'major_name' => "ELO"
        ));
        //id = 3
        DB::table('majors')->insert(array(

            'study_id' => 2,
            'major_name' => "EM"
        ));
        //id = 4
        DB::table('majors')->insert(array(
            'study_id' => 2,
            'major_name' => "ENT"
        ));

        /**
         * IDs hier hetzelfde laten aub
         * Deze worden gebruikt om de rol van de user te bepalen
         */
        //id = 5
        DB::table('majors')->insert(array(
            'study_id' => 3,
            'major_name' => "Docent"
        ));
        //id = 6
        DB::table('majors')->insert(array(
            'study_id' => 3,
            'major_name' => "Extern"
        ));


    }
}

<?php

use Illuminate\Database\Seeder;

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('majors')->insert(array(
            'study_id' => 1,
            'major_name' => "ICT"
        ));
        DB::table('majors')->insert(array(

            'study_id' => 1,
            'major_name' => "ELO"
        ));


        DB::table('majors')->insert(array(

            'study_id' => 2,
            'major_name' => "EM"
        ));
        DB::table('majors')->insert(array(
            'study_id' => 2,
            'major_name' => "ENT"
        ));

        DB::table('majors')->insert(array(
            'study_id' => 3,
            'major_name' => "Begeleider"
        ));

        DB::table('majors')->insert(array(
            'study_id' => 3,
            'major_name' => "Organisator"
        ));

        DB::table('majors')->insert(array(
            'study_id' => 3,
            'major_name' => "Extern"
        ));


    }
}

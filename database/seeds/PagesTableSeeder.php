<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pages')->insert([
            "name" => "Amerika 2017",
            "content" => "Een lange text die de afgelopen reis naar Amerika beschrijft.",
            "type" => "html",
        ]);
        DB::table('pages')->insert([
            "name" => "Duitsland 2017",
            "content" => "Een lange text die de afgelopen reis naar Duitsland beschrijft.",
            "type" => "html",
        ]);
    }
}

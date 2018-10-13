<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Stefan Segers */
        DB::table('users')->insert([
            'name' => 'u0568928',
            'password' => bcrypt('stefan'),
            'role' => 'organizer',
        ]);

        /* Yoeri op't Roodt*/
        DB::table('users')->insert([
            'name' => 'r0663911',
            'password' => bcrypt('yoeri'),
            'role' => 'traveller',
        ]);
    }
}

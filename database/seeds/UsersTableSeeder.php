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
        DB::table('users')->insert([
            'name' => 'r0663911',
            'password' => bcrypt('yoeri'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
           'name' => 'Begeleider',
           'password' => bcrypt('azertyuiop'),
           'role' => 'Begeleider',
        ]);

        DB::table('users')->insert([
            'name' => 'Organisator',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Organisator',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'beheerder',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Beheerder',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Begeleider',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Begeleider',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);
        DB::table('users')->insert([
            'name' => 'Reiziger',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);
    }
}

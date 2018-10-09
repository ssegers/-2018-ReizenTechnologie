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
           'name' => 'Begeleider',
           'email' => 'r0123456@ucll.be',
           'password' => bcrypt('azertyuiop'),
           'role' => 'Begeleider',
        ]);

        DB::table('users')->insert([
            'name' => 'Organisator',
            'email' => 'r1123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Organisator',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'email' => 'r2123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Beheerder',
            'email' => 'r3123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Beheerder',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'email' => 'r4123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Begeleider',
            'email' => 'r5123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Begeleider',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'email' => 'r6123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'email' => 'r7123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);

        DB::table('users')->insert([
            'name' => 'Reiziger',
            'email' => 'r8123456@ucll.be',
            'password' => bcrypt('azertyuiop'),
            'role' => 'Reiziger',
        ]);
    }
}

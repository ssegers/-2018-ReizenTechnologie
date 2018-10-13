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
        // Stefan Segers
        DB::table('users')->insert([
            'name' => 'u05986734',
            'password' => bcrypt('stefan'),
            'role' => 'organizer',
        ]);
        // Rudi Roox
        DB::table('users')->insert([
            'name' => 'u05698024',
            'password' => bcrypt('rudi'),
            'role' => 'organizer',
        ]);
        // Daan Vandebosch
        DB::table('users')->insert([
            'name' => 'r0664592',
            'password' => bcrypt('daan'),
            'role' => 'traveller',
        ]);
        // Kaan Akpinar
        DB::table('users')->insert([
            'name' => 'r0577574',
            'password' => bcrypt('kaan'),
            'role' => 'traveller',
        ]);
        // Joren Meynen
        DB::table('users')->insert([
            'name' => 'r0674424',
            'password' => bcrypt('joren'),
            'role' => 'traveller',
        ]);
        // Michiel Guilliams
        DB::table('users')->insert([
            'name' => 'r0668515',
            'password' => bcrypt('michiel'),
            'role' => 'traveller',
        ]);
        // Nicolaas Schelfhout
        DB::table('users')->insert([
            'name' => 'r0679934',
            'password' => bcrypt('nicolaas'),
            'role' => 'traveller',
        ]);
        // Robin Machiels
        DB::table('users')->insert([
            'name' => 'r0664407',
            'password' => bcrypt('robin'),
            'role' => 'traveller',
        ]);
        // Sasha Van De Voorde
        DB::table('users')->insert([
            'name' => 'r0673786',
            'password' => bcrypt('sasha'),
            'role' => 'traveller',
        ]);
        // Stef Kerkhofs
        DB::table('users')->insert([
            'name' => 'r0658314',
            'password' => bcrypt('stef'),
            'role' => 'traveller',
        ]);
        // Yoeri op't Roodt
        DB::table('users')->insert([
            'name' => 'r0663911',
            'password' => bcrypt('yoer'),
            'role' => 'traveller',
        ]);
    }
}

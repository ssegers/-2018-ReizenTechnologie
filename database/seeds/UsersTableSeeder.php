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

        // Standaard Gebruiker
        DB::table('users')->insert([
            'name' => '',
            'password' => '',
            'role' => 'guest'
        ]);

        // Stefan Segers
        DB::table('users')->insert([
            'name' => 'u0598673',
            'password' => bcrypt('stefan'),
            'role' => 'organizer',
        ]);

        // Rudi Roox
        DB::table('users')->insert([
            'name' => 'u0569802',
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
            'password' => bcrypt('yoeri'),
            'role' => 'traveller',
        ]);


        // Jan Modaal
        DB::table('users')->insert([
            'name' => 'r1234567',
            'password' => bcrypt('jan'),
            'role' => 'traveller',
        ]);


        //Piet Janssen
        DB::table('users')->insert([
            'name' => 'r7891011',
            'password' => bcrypt('piet'),
            'role' => 'traveller',
        ]);

        //Toon Peters
        DB::table('users')->insert([
            'name' => 'r1112131',
            'password' => bcrypt('toon'),
            'role' => 'traveller',
        ]);

        //Gert Nullens
        DB::table('users')->insert([
            'name' => 'r1415161',
            'password' => bcrypt('gert'),
            'role' => 'traveller',
        ]);

        //Bram Bongers
        DB::table('users')->insert([
            'name' => 'r1718192',
            'password' => bcrypt('bram'),
            'role' => 'traveller',
        ]);

        //Tom Moons
        DB::table('users')->insert([
            'name' => 'r2021222',
            'password' => bcrypt('tom'),
            'role' => 'traveller',
        ]);

        //Jens Janssen
        DB::table('users')->insert([
            'name' => 'r2324252',
            'password' => bcrypt('jens'),
            'role' => 'traveller',
        ]);

        //Martijn Theunissen
        DB::table('users')->insert([
            'name' => 'r2627282',
            'password' => bcrypt('martijn'),
            'role' => 'traveller',
        ]);

        //Steve Stevens
        DB::table('users')->insert([
            'name' => 'r2930313',
            'password' => bcrypt('steve'),
            'role' => 'traveller',
        ]);

        //Dario Thielens
        DB::table('users')->insert([
            'name' => 'r3233343',
            'password' => bcrypt('dario'),
            'role' => 'traveller',
        ]);

        //Bert Bertens
        DB::table('users')->insert([
            'name' => 'r3536373',
            'password' => bcrypt('bert'),
            'role' => 'traveller',
        ]);

        //Piet Pieters
        DB::table('users')->insert([
            'name' => 'r3839404',
            'password' => bcrypt('piet'),
            'role' => 'traveller',
        ]);

        //Rudy Verboven
        DB::table('users')->insert([
            'name' => 'r4142434',
            'password' => bcrypt('rudy'),
            'role' => 'traveller',
        ]);

        //Johnny Bravo
        DB::table('users')->insert([
            'name' => 'r4445464',
            'password' => bcrypt('johnny'),
            'role' => 'traveller',
        ]);

        //Bjorn Mertens
        DB::table('users')->insert([
            'name' => 'r4748495',
            'password' => bcrypt('bjorn'),
            'role' => 'traveller',
        ]);

        //Jan Tomassen
        DB::table('users')->insert([
            'name' => 'r5051525',
            'password' => bcrypt('jan'),
            'role' => 'traveller',
        ]);

        //Vincent Ramaekers
        DB::table('users')->insert([
            'name' => 'r5354555',
            'password' => bcrypt('vincent'),
            'role' => 'traveller',
        ]);

        //Glenn Vanaken
        DB::table('users')->insert([
            'name' => 'r5657585',
            'password' => bcrypt('glenn'),
            'role' => 'traveller',
        ]);

        //Roel Aegten
        DB::table('users')->insert([
            'name' => 'r5960616',
            'password' => bcrypt('roel'),
            'role' => 'traveller',
        ]);




        //More Dummy Data
        DB::table('users')->insert([
            'name' => 'r0000032',
            'password' => bcrypt('0000032'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000033',
            'password' => bcrypt('0000033'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000034',
            'password' => bcrypt('0000034'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000035',
            'password' => bcrypt('0000035'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000036',
            'password' => bcrypt('0000036'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000037',
            'password' => bcrypt('0000037'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000038',
            'password' => bcrypt('0000038'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000039',
            'password' => bcrypt('0000039'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000040',
            'password' => bcrypt('0000040'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000041',
            'password' => bcrypt('0000041'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000042',
            'password' => bcrypt('0000042'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000043',
            'password' => bcrypt('0000043'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000044',
            'password' => bcrypt('0000044'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000045',
            'password' => bcrypt('0000045'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000046',
            'password' => bcrypt('0000046'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000047',
            'password' => bcrypt('0000047'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000048',
            'password' => bcrypt('0000048'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000049',
            'password' => bcrypt('0000049'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000050',
            'password' => bcrypt('0000050'),
            'role' => 'traveller',
        ]);


    }
}

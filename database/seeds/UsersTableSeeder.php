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
            'password' => bcrypt('yoer'),
            'role' => 'traveller',
        ]);







        //More Dummy Data
        DB::table('users')->insert([
            'name' => 'r0000001',
            'password' => bcrypt('0000001'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000002',
            'password' => bcrypt('0000002'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000003',
            'password' => bcrypt('0000003'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000004',
            'password' => bcrypt('0000004'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000005',
            'password' => bcrypt('0000005'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000006',
            'password' => bcrypt('0000006'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000007',
            'password' => bcrypt('0000007'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000008',
            'password' => bcrypt('0000008'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000009',
            'password' => bcrypt('0000009'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000010',
            'password' => bcrypt('0000010'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000011',
            'password' => bcrypt('0000011'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000012',
            'password' => bcrypt('0000012'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000013',
            'password' => bcrypt('0000013'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000014',
            'password' => bcrypt('0000014'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000015',
            'password' => bcrypt('0000015'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000016',
            'password' => bcrypt('0000016'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000017',
            'password' => bcrypt('0000017'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000018',
            'password' => bcrypt('0000018'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000019',
            'password' => bcrypt('0000019'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000020',
            'password' => bcrypt('0000020'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000021',
            'password' => bcrypt('0000021'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000022',
            'password' => bcrypt('0000022'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000023',
            'password' => bcrypt('0000023'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000024',
            'password' => bcrypt('0000024'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000025',
            'password' => bcrypt('0000025'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000026',
            'password' => bcrypt('0000026'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000027',
            'password' => bcrypt('0000027'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000028',
            'password' => bcrypt('0000028'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000029',
            'password' => bcrypt('0000029'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000030',
            'password' => bcrypt('0000030'),
            'role' => 'traveller',
        ]);
        DB::table('users')->insert([
            'name' => 'r0000031',
            'password' => bcrypt('0000031'),
            'role' => 'traveller',
        ]);
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

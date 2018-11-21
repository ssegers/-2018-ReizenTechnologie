<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Stefan Segers
        DB::table('travellers')->insert([
            'user_id' => 2,
            'trip_id' => 1,
            'zip_id' =>1,
            'major_id' =>3,
            'first_name' => 'Stefan',
            'last_name' => 'Segers',
            'email' => 'stefan.segers@ucll.be',
            'country' => 'belgië',
            'address' => 'sprinkhaanstraat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Rudi Roox
        DB::table('travellers')->insert([
            'user_id' => 3,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Rudi',
            'last_name' => 'Roox',
            'email' => 'rudi.roox@ucll.be',
            'country' => 'belgië',
            'address' => 'herenstraat 35',
            'gender' => 'man',
            'phone' => '0470825096',
            'emergency_phone_1' => '011335526',
            'emergency_phone_2' => null,
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Genk',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Daan Vandebosch
        DB::table('travellers')->insert([
            'user_id' => 4,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Daan',
            'last_name' => 'Vandebosch',
            'email' => 'daan.vandebosch@student.ucll.be',
            'country' => 'belgië',
            'address' => 'daan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Kaan Akpinar
        DB::table('travellers')->insert([
            'user_id' => 5,
            'trip_id' => 1,
            'zip_id' =>4,
            'major_id' =>1,
            'first_name' => 'Kaan',
            'last_name' => 'Akpinar',
            'email' => 'kaan.akpinar@student.ucll.be',
            'country' => 'belgië',
            'address' => 'kaan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Joren Meynen
        DB::table('travellers')->insert([
            'user_id' => 6,
            'trip_id' => 1,
            'zip_id' =>3,
            'major_id' =>1,
            'first_name' => 'Joren',
            'last_name' => 'Meynen',
            'email' => 'joren.meynen@student.ucll.be',
            'country' => 'belgië',
            'address' => 'joren zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Michiel Guilliams
        DB::table('travellers')->insert([
            'user_id' => 7,
            'trip_id' => 2,
            'zip_id' =>1,
            'major_id' =>1,
            'first_name' => 'Michiel',
            'last_name' => 'Guilliams',
            'email' => 'michiel.guilliams@student.ucll.be',
            'country' => 'belgië',
            'address' => 'michiel zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Nicolaas Schelfhout
        DB::table('travellers')->insert([
            'user_id' => 8,
            'trip_id' => 1,
            'zip_id' =>3,
            'major_id' =>1,
            'first_name' => 'Nicolaas',
            'last_name' => 'Schelfhout',
            'email' => 'nicolaas.schelfhout@ucll.be',
            'country' => 'belgië',
            'address' => 'nicolaas zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Robin Machiels
        DB::table('travellers')->insert([
            'user_id' => 9,
            'trip_id' => 2,
            'zip_id' =>3,
            'major_id' =>1,
            'first_name' => 'Robin',
            'last_name' => 'Machiels',
            'email' => 'robin.machiels@student.ucll.be',
            'country' => 'belgië',
            'address' => 'robin zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Sasha Van De Voorde
        DB::table('travellers')->insert([
            'user_id' => 10,
            'trip_id' => 1,
            'zip_id' =>5,
            'major_id' =>1,
            'first_name' => 'Sasha',
            'last_name' => 'Vandevoorde',
            'email' => 'sasha.vandevoorde@student.ucll.be',
            'country' => 'belgië',
            'address' => 'sasha zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Stef Kerkhofs
        DB::table('travellers')->insert([
            'user_id' => 11,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Stef',
            'last_name' => 'Kerkhofs',
            'email' => 'stef.kerkhofs@student.ucll.be',
            'country' => 'belgië',
            'address' => 'stef zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Yoeri op't Roodt
        DB::table('travellers')->insert([
            'user_id' => 12,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Yoeri',
            'last_name' => "op't Roodt",
            'email' => 'yoeri.optroodt@student.ucll.be',
            'country' => 'belgië',
            'address' => 'yoeri zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        // Jan Modaal
        DB::table('travellers')->insert([
            'user_id' => 13,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Jan',
            'last_name' => "Modaal",
            'email' => 'jan.modaal@student.ucll.be',
            'country' => 'belgië',
            'address' => 'jan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Piet Janssen
        DB::table('travellers')->insert([
            'user_id' => 14,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Piet',
            'last_name' => "Janssen",
            'email' => 'piet.janssen@student.ucll.be',
            'country' => 'belgië',
            'address' => 'piet zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Toon Peeters
        DB::table('travellers')->insert([
            'user_id' => 15,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Toon',
            'last_name' => "Peeters",
            'email' => 'toon.peters@student.ucll.be',
            'country' => 'belgië',
            'address' => 'toon zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Gert Nullens
        DB::table('travellers')->insert([
            'user_id' => 16,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Gert',
            'last_name' => "Nullens",
            'email' => 'gert.nullens@student.ucll.be',
            'country' => 'belgië',
            'address' => 'gert zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Bram Bongers
        DB::table('travellers')->insert([
            'user_id' => 17,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Bram',
            'last_name' => "Bongers",
            'email' => 'bram.bongers@student.ucll.be',
            'country' => 'belgië',
            'address' => 'bram zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Tom Moons
        DB::table('travellers')->insert([
            'user_id' => 18,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Tom',
            'last_name' => "Moons",
            'email' => 'tom.moons@student.ucll.be',
            'country' => 'belgië',
            'address' => 'tom zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Jens Janssen
        DB::table('travellers')->insert([
            'user_id' => 19,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Jens',
            'last_name' => "Janssen",
            'email' => 'jens.janssen@student.ucll.be',
            'country' => 'belgië',
            'address' => 'jens zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Martijn Theunissen
        DB::table('travellers')->insert([
            'user_id' => 20,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Martijn',
            'last_name' => "Theunissen",
            'email' => 'Martijn.Theunissen@student.ucll.be',
            'country' => 'belgië',
            'address' => 'martijn zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Steve Stevens
        DB::table('travellers')->insert([
            'user_id' => 21,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Steve',
            'last_name' => "Stevens",
            'email' => 'steve.stevens@student.ucll.be',
            'country' => 'belgië',
            'address' => 'steve zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Dario Thielens
        DB::table('travellers')->insert([
            'user_id' => 22,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Dario',
            'last_name' => "Thielens",
            'email' => 'dario.thielens@student.ucll.be',
            'country' => 'belgië',
            'address' => 'dario zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);


        //Bert Bertens
        DB::table('travellers')->insert([
            'user_id' => 23,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Bert',
            'last_name' => "Bertens",
            'email' => 'bert.bertens@student.ucll.be',
            'country' => 'belgië',
            'address' => 'bert zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);



        //Piet Pieters
        DB::table('travellers')->insert([
            'user_id' => 24,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Piet',
            'last_name' => "Pieters",
            'email' => 'piet.pieters@student.ucll.be',
            'country' => 'belgië',
            'address' => 'piet zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);



        //Rudy Verboven
        DB::table('travellers')->insert([
            'user_id' => 25,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Rudy',
            'last_name' => "Verboven",
            'email' => 'rudy.verboven@student.ucll.be',
            'country' => 'belgië',
            'address' => 'rudy zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);



        //Johnny Bravo
        DB::table('travellers')->insert([
            'user_id' => 26,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Johnny',
            'last_name' => "Bravo",
            'email' => 'johnny.bravo@student.ucll.be',
            'country' => 'belgië',
            'address' => 'johnny zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Bjorn Mertens
        DB::table('travellers')->insert([
            'user_id' => 27,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Bjorn',
            'last_name' => "Mertens",
            'email' => 'bjorn.mertens@student.ucll.be',
            'country' => 'belgië',
            'address' => 'bjorn zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Jan Tomassen
        DB::table('travellers')->insert([
            'user_id' => 28,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Jan',
            'last_name' => "Tomassen",
            'email' => 'jan.tomassen@student.ucll.be',
            'country' => 'belgië',
            'address' => 'jan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Vincent Ramaekers
        DB::table('travellers')->insert([
            'user_id' => 29,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Vincent',
            'last_name' => "Ramaekers",
            'email' => 'vincent.ramaekers@student.ucll.be',
            'country' => 'belgië',
            'address' => 'vincent zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Glenn Vanaken
        DB::table('travellers')->insert([
            'user_id' => 30,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Glenn',
            'last_name' => "Vanaken",
            'email' => 'glenn.vanaken@student.ucll.be',
            'country' => 'belgië',
            'address' => 'glenn zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        //Roel Aegten
        DB::table('travellers')->insert([
            'user_id' => 31,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => 'Roel',
            'last_name' => "Aegten",
            'email' => 'roel.aegten@student.ucll.be',
            'country' => 'belgië',
            'address' => 'roel zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);



        //More Dummy Data
        DB::table('travellers')->insert([
            'user_id' => 32,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '32',
            'last_name' => "32",
            'email' => '32@student.ucll.be',
            'country' => '32',
            'address' => '32',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 33,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '33',
            'last_name' => "33",
            'email' => '33@student.ucll.be',
            'country' => '33',
            'address' => '33',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 34,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '34',
            'last_name' => "34",
            'email' => '34@student.ucll.be',
            'country' => '34',
            'address' => '34',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 35,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '35',
            'last_name' => "35",
            'email' => '35@student.ucll.be',
            'country' => '35',
            'address' => '35',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 36,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '36',
            'last_name' => "36",
            'email' => '36@student.ucll.be',
            'country' => '36',
            'address' => '36',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 37,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '37',
            'last_name' => "37",
            'email' => '37@student.ucll.be',
            'country' => '37',
            'address' => '37',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 38,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '38',
            'last_name' => "38",
            'email' => '38@student.ucll.be',
            'country' => '38',
            'address' => '38',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 39,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '39',
            'last_name' => "39",
            'email' => '39@student.ucll.be',
            'country' => '39',
            'address' => '39',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 40,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '40',
            'last_name' => "40",
            'email' => '40@student.ucll.be',
            'country' => '40',
            'address' => '40',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 41,
            'trip_id' => 1,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '41',
            'last_name' => "41",
            'email' => '41@student.ucll.be',
            'country' => '41',
            'address' => '41',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 42,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '42',
            'last_name' => "42",
            'email' => '42@student.ucll.be',
            'country' => '42',
            'address' => '42',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 43,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '43',
            'last_name' => "43",
            'email' => '43@student.ucll.be',
            'country' => '43',
            'address' => '43',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 44,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '44',
            'last_name' => "44",
            'email' => '44@student.ucll.be',
            'country' => '44',
            'address' => '44',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 45,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '45',
            'last_name' => "45",
            'email' => '45@student.ucll.be',
            'country' => '45',
            'address' => '45',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 46,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '46',
            'last_name' => "46",
            'email' => '46@student.ucll.be',
            'country' => '46',
            'address' => '46',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 47,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '47',
            'last_name' => "47",
            'email' => '47@student.ucll.be',
            'country' => '47',
            'address' => '47',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 48,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '48',
            'last_name' => "48",
            'email' => '48@student.ucll.be',
            'country' => '48',
            'address' => '48',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 49,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '49',
            'last_name' => "49",
            'email' => '49@student.ucll.be',
            'country' => '49',
            'address' => '49',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);
        DB::table('travellers')->insert([
            'user_id' => 50,
            'trip_id' => 2,
            'zip_id' =>2,
            'major_id' =>1,
            'first_name' => '50',
            'last_name' => "50",
            'email' => '50@student.ucll.be',
            'country' => '50',
            'address' => '50',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '2000-01-01',
            'birthplace' => 'Diest',
            'iban' => 'BE68539007547034',
            'medical_issue' => false,
            'medical_info' => null
        ]);

    }
}

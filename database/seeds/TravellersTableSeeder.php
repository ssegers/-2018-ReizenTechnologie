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
            'birthdate' => '01/01/2000',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/05/1996',
            'birthplace' => 'Genk',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1998',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
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
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'iban' => 'BE001111222233334',
            'medical_issue' => false,
            'medical_info' => null
        ]);
    }
}

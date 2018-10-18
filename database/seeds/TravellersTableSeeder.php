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
            'user_id' => 1,
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
            'user_id' => 2,
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
            'user_id' => 3,
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
            'user_id' => 4,
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
            'user_id' => 5,
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
            'user_id' => 6,
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
            'user_id' => 7,
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
            'user_id' => 8,
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
            'user_id' => 9,
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
            'user_id' => 10,
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
            'user_id' => 11,
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
    }
}

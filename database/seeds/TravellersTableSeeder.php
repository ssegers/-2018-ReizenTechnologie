<?php

use Illuminate\Database\Seeder;

class TravellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travellers')->insert([
            'firstname' => 'Stefan',
            'lastname' => 'Segers',
            'country' => 'belgië',
            'address' => 'sprinkhaanstraat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/2000',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Robin',
            'lastname' => 'Machiels',
            'country' => 'belgië',
            'address' => 'herenstraat 35',
            'gender' => 'man',
            'phone' => '0470825096',
            'emergency_phone_1' => '011335526',
            'emergency_phone_2' => null,
            'nationality' => 'belg',
            'birthdate' => '01/05/1996',
            'birthplace' => 'Genk',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Stef',
            'lastname' => 'Kerkhofs',
            'country' => 'belgië',
            'address' => 'stef zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1998',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Nico',
            'lastname' => 'Schelfhout',
            'country' => 'belgië',
            'address' => 'Nico zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Michiel',
            'lastname' => 'Guilliaums',
            'country' => 'belgië',
            'address' => 'Michiel zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Yoeri',
            'lastname' => "Op't Roodt",
            'country' => 'belgië',
            'address' => 'Yoeri zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Daan',
            'lastname' => 'Vandebosch',
            'country' => 'belgië',
            'address' => 'Daan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Joren',
            'lastname' => 'Meynen',
            'country' => 'belgië',
            'address' => 'Joren zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Sasha',
            'lastname' => 'Vandevoorde',
            'country' => 'belgië',
            'address' => 'Sasha zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);

        DB::table('travellers')->insert([
            'firstname' => 'Kaan',
            'lastname' => 'Akpinar',
            'country' => 'belgië',
            'address' => 'Kaan zijn straat 15',
            'gender' => 'man',
            'phone' => '0474567892',
            'emergency_phone_1' => '0471852963',
            'emergency_phone_2' => '0471717171',
            'nationality' => 'belg',
            'birthdate' => '01/01/1995',
            'birthplace' => 'Diest',
            'medical_issue' => false,
            'medical_info' => null
        ]);
    }
}

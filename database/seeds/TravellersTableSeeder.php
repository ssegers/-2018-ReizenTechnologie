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
            'user_id' => 1,
            'first_name' => 'Stefan',
            'last_name' => 'Segers',
            'email' => 'r0123456@ucll.be',
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
            'user_id' => 2,
            'first_name' => 'Robin',
            'last_name' => 'Machiels',
            'email' => 'r2123456@ucll.be',
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
            'user_id' => 3,
            'first_name' => 'Stef',
            'last_name' => 'Kerkhofs',
            'email' => 'r3123456@ucll.be',
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
            'user_id' => 4,
            'first_name' => 'Nico',
            'last_name' => 'Schelfhout',
            'email' => 'r4123456@ucll.be',
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
            'user_id' => 5,
            'first_name' => 'Michiel',
            'last_name' => 'Guilliaums',
            'email' => 'r5123456@ucll.be',
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
            'user_id' => 6,
            'first_name' => 'Yoeri',
            'last_name' => "Op't Roodt",
            'email' => 'r6123456@ucll.be',
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
            'user_id' => 7,
            'first_name' => 'Daan',
            'last_name' => 'Vandebosch',
            'email' => 'r7123456@ucll.be',
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
            'user_id' => 8,
            'first_name' => 'Joren',
            'last_name' => 'Meynen',
            'email' => 'r823456@ucll.be',
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
            'user_id' => 9,
            'first_name' => 'Sasha',
            'last_name' => 'Vandevoorde',
            'email' => 'r9123456@ucll.be',
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
            'user_id' => 10,
            'first_name' => 'Kaan',
            'last_name' => 'Akpinar',
            'email' => 'r9923456@ucll.be',
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

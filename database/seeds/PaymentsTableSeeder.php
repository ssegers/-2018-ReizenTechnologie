<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<50;$i++){
            DB::table('payments')->insert([
                'travellers_per_trip_id' => $i,
                'amount' => 200
            ]);
        }
        DB::table('payments')->insert([
            'travellers_per_trip_id' => 1,
            'amount' => 300
        ]);
    }
}

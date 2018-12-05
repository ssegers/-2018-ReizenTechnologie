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
                'traveller_id' => $i,
                'amount' => 200
            ]);
        }

    }
}

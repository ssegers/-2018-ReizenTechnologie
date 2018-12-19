<?php

use App\Traveller;
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
        $travellers = Traveller::select('traveller_id')->get();
        for($i = 1; $i<count($travellers);$i++){
            DB::table('payments')->insert([
                'traveller_id' => $i,
                'amount' => 0
            ]);
        }

    }
}

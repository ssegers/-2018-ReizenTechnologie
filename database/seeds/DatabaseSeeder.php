<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TripsTableSeeder::class,
            ZipTableSeeder::class,
            StudiesTableSeeder::class,
            MajorsTableSeeder::class,
            TravellersTableSeeder::class,
            PagesTableSeeder::class,
            HotelsSeeder::class,
            AutosSeeder::class,
            HotelsPerTripSeeder::class,
            AutosPerTripSeeder::class,
            TravellersPerTripSeeder::class,
            TravellersPerAutoSeeder::class,
            RoomsPerHotelPerTripSeeder::class,
            TravellersPerRoomSeeder::class,
            PaymentsTableSeeder::class,
        ]);
    }
}

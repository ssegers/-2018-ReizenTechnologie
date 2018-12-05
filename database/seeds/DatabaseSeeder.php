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
            TravellersTableSeeder::class,
            TripsTableSeeder::class,
            ZipTableSeeder::class,
            StudiesTableSeeder::class,
            MajorsTableSeeder::class,
            PagesTableSeeder::class,
            TripOrganizerSeeder::class,
            HotelsSeeder::class,
            HotelsPerTripSeeder::class,
            RoomsPerHotelPerTripSeeder::class,
            TravellersPerRoomSeeder::class,
            PaymentsTableSeeder::class,
        ]);
    }
}

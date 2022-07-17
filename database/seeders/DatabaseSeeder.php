<?php

namespace Database\Seeders;

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
            AddonSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            FaqSeeder::class,
            PackageSeeder::class,
            AccommodationSeeder::class,
            ImageSeeder::class,
            RatingSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}

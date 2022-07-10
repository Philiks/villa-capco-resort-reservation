<?php

namespace Database\Seeders;

use App\Facades\Format;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name' => "Morning",
            'rate' => Format::moneyForDatabase(10_000),
            'max_people' => 25,
            'details' => '2 beds,2 bathrooms,2 pools,1 function hall',
            'start_time' => Format::stringTimeForDatabase('08:00 AM'),
            'end_time' => Format::stringTimeForDatabase('06:00 PM'),
        ]);

        Package::create([
            'name' => "Evening",
            'rate' => Format::moneyForDatabase(13_000),
            'max_people' => 25,
            'details' => '3 beds,2 bathrooms,2 pools,1 function hall',
            'start_time' => Format::stringTimeForDatabase('07:00 PM'),
            'end_time' => Format::stringTimeForDatabase('06:00 AM'),
        ]);

        Package::create([
            'name' => "Whole Day",
            'rate' => Format::moneyForDatabase(25_000),
            'max_people' => 30,
            'details' => '4 bed,3 bathrooms,3 pools,1 function hall',
            'start_time' => Format::stringTimeForDatabase('08:00 AM'),
            'end_time' => Format::stringTimeForDatabase('08:00 AM'),
        ]);
    }
}

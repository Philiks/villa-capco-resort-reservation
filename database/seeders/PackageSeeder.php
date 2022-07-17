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
            'start_time' => Format::stringTimeForDatabase('08:00 AM'),
            'end_time' => Format::stringTimeForDatabase('06:00 PM'),
        ]);

        Package::create([
            'name' => "Evening",
            'start_time' => Format::stringTimeForDatabase('07:00 PM'),
            'end_time' => Format::stringTimeForDatabase('06:00 AM'),
        ]);

        Package::create([
            'name' => "Whole Day",
            'start_time' => Format::stringTimeForDatabase('08:00 AM'),
            'end_time' => Format::stringTimeForDatabase('08:00 AM'),
        ]);
    }
}

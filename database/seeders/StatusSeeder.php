<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Booked',
        ]);

        Status::create([
            'name' => 'Rebooked',
        ]);

        Status::create([
            'name' => 'Cancelled',
        ]);

        Status::create([
            'name' => 'Done',
        ]);
    }
}

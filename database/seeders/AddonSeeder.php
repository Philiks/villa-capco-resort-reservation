<?php

namespace Database\Seeders;

use App\Facades\Format;
use App\Models\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Addon::create([
            'name' => 'Additional Person',
            'rate' => Format::moneyForDatabase(100),
        ]);

        Addon::create([
            'name' => 'Karaoke',
            'rate' => Format::moneyForDatabase(250),
        ]);
    }
}

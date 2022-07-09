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
            'package_id' => Addon::ADDON_FOR_ALL_PACKAGES,
            'name' => 'Additional Person',
            'rate' => Format::moneyForDatabase(100),
        ]);

        Addon::create([
            'package_id' => Addon::ADDON_FOR_ALL_PACKAGES,
            'name' => 'Karaoke',
            'rate' => Format::moneyForDatabase(250),
        ]);
    }
}

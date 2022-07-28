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
            'name' => 'Function Hall (if you rent Pools 1-4)',
            'description' => 'A facility that serves place for people who wanted to celebate specific occasions. Can be partnered with your pool of choice.',
            'rate' => Format::moneyForDatabase(10_000),
            'image_path' => 'images/addons/function hall.jpg',
        ]);

        Addon::create([
            'name' => 'Barbeque Grill',
            'description' => 'Make your food a little tastier and grizzling hot with our barbeque grill. Coal are also provided for a fixed set of bags.',
            'rate' => Format::moneyForDatabase(200),
            'image_path' => 'images/addons/bbq grill.jpg',
        ]);

        Addon::create([
            'name' => 'Karaoke',
            'description' => 'Sing to your heart\'s content and showcase your voice with our karaoke that has wide variety of songs.',
            'rate' => Format::moneyForDatabase(250),
            'image_path' => 'images/addons/karaoke.jpg',
        ]);

        Addon::create([
            'name' => 'Additional Person',
            'description' => 'Invite more of your friends and family. You can add more people if the limit has been reached.',
            'rate' => Format::moneyForDatabase(100),
            'image_path' => 'images/addons/additional person.png',
        ]);

        Addon::create([
            'name' => 'Balloons & Party Supplies',
            'description' => 'It\' party time! We can provided you with basic party stuffy that will bring more life to your celebration.',
            'rate' => Format::moneyForDatabase(5_000),
            'image_path' => 'images/addons/balloons and party.jpg',
        ]);
    }
}

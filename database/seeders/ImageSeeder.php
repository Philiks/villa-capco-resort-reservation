<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'accommodation_id' => 1,
            'file_path' => 'images/accommodations/pool_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 1,
            'file_path' => 'images/accommodations/pool_1_room_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => 'images/accommodations/pool_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => 'images/accommodations/pool_2_room_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => 'images/accommodations/pool_2_room_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => 'images/accommodations/pool_3_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => 'images/accommodations/pool_3_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => 'images/accommodations/pool_3_room_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => 'images/accommodations/pool_3_room_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => 'images/accommodations/pool_4.jpg'
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => 'images/accommodations/pool_4_room_1.png'
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => 'images/accommodations/pool_4_room_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => 'images/accommodations/pool_4_room_3.jpg'
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => 'images/accommodations/function_hall_1.jpg'
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => 'images/accommodations/function_hall_2.jpg'
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => 'images/accommodations/function_hall_3.jpg'
        ]);
    }
}

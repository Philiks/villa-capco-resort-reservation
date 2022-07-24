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
            'file_path' => asset('storage/images/accommodations/pool 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 1,
            'file_path' => asset('storage/images/accommodations/pool 1 - room 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => asset('storage/images/accommodations/pool 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => asset('storage/images/accommodations/pool 2 - room 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 2,
            'file_path' => asset('storage/images/accommodations/pool 2 - room 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => asset('storage/images/accommodations/pool 3 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => asset('storage/images/accommodations/pool 3 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => asset('storage/images/accommodations/pool 3 - room 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 3,
            'file_path' => asset('storage/images/accommodations/pool 3 - room 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => asset('storage/images/accommodations/pool 4.jpg')
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => asset('storage/images/accommodations/pool 4 - room 1.png')
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => asset('storage/images/accommodations/pool 4 - room 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 4,
            'file_path' => asset('storage/images/accommodations/pool 4 - room 3.jpg')
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => asset('storage/images/accommodations/function hall 1.jpg')
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => asset('storage/images/accommodations/function hall 2.jpg')
        ]);

        Image::create([
            'accommodation_id' => 5,
            'file_path' => asset('storage/images/accommodations/function hall 3.jpg')
        ]);
    }
}

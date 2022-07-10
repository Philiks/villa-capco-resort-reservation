<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'package_id' => 1,
            'file_path' => asset('storage/images/no-thumbnail.png')
        ]);
        // TODO: Create real data based on the pictures passed in google docs.
    }
}

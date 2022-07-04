<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->count(3)
            ->create();
        
        $users[0]->ratings()->createMany([
            [
                'comment' => 'Really Great Place will definitely book again.',
                'rating_score' => 5,
                'is_featured' => true,
            ],
            [
                'comment' => 'Had wonderful time with my batchmates from Batch 2002.',
                'rating_score' => 5,
            ]
        ]);
        
        $users[1]->ratings()->create([
            'comment' => 'Pool is very clean and the place is wide enough for our family reunion.',
            'rating_score' => 5,
            'is_featured' => true,
        ]);
        
        $users[2]->ratings()->create([
            'comment' => 'Really close to our residence and very affordable.',
            'rating_score' => 5,
            'is_featured' => true,
        ]);
    }
}

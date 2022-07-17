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
        $users = User::where('id', '!=', 1/* admin */)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        
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
        
        $users[3]->ratings()->create([
            'comment' => 'The Pool 3 accommodation was amazing. Will reserve again in with my family.',
            'rating_score' => 5,
            'is_featured' => true,
        ]);
        
        $users[4]->ratings()->create([
            'comment' => 'The function hall was spacious enough for the debut.',
            'rating_score' => 5,
            'is_featured' => false,
        ]);
        
        $users[5]->ratings()->create([
            'comment' => 'Had fun with my blockmates.',
            'rating_score' => 4,
            'is_featured' => false,
        ]);
        
        $users[6]->ratings()->create([
            'comment' => 'Pool 4 is a little bit pricy but worth it.',
            'rating_score' => 4,
            'is_featured' => false,
        ]);
        
        $users[7]->ratings()->create([
            'comment' => 'Function had shortage of chair unfortunately.',
            'rating_score' => 3,
            'is_featured' => false,
        ]);
        
        $users[8]->ratings()->create([
            'comment' => 'The pool was not that freezing cold at night; we enjoyed it.',
            'rating_score' => 5,
            'is_featured' => false,
        ]);
        
        $users[9]->ratings()->create([
            'comment' => 'Hoped to have some place to cook barbeques.',
            'rating_score' => 4,
            'is_featured' => false,
        ]);
    }
}

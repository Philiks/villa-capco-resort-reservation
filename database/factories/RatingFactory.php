<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->pluck('id')->first(),
            'comment' => $this->faker->realText(250),
            'rating_score' => $this->faker->numberBetween(1, 5),
            'is_featured' => $this->faker->boolean(),
        ];
    }
}

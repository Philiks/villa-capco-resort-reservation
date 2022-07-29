<?php

namespace Database\Factories;

use App\Facades\Format;
use App\Models\Addon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addon>
 */
class AddonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($this->faker->numberBetween(4, 6)),
            'description' => $this->faker->sentence($this->faker->numberBetween(8, 10)),
            'rate' => Format::moneyForDatabase($this->faker->numberBetween(200, 500)),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}

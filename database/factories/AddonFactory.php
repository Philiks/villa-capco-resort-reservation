<?php

namespace Database\Factories;

use App\Facades\Format;
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
            'name' => $this->faker->sentece($this->faker->numberBetween(4, 6)),
            'rate' => Format::moneyForDatabase($this->faker->numberBetween(200, 500)),
        ];
    }
}

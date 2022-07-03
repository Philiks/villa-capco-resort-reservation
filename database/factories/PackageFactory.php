<?php

namespace Database\Factories;

use App\Facades\Format;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
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
            'rate' => Format::moneyForDatabase($this->faker->numberBetween(6_000, 8_000)),
            'max_people' => $this->faker->numberBetween(20, 30),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
        ];
    }
}

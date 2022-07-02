<?php

namespace Database\Factories;

use App\Facades\Format;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'package_id' => Package::factory()->create(),
            'no_of_people' => $faker->numberBetween(20, 30),
            'amount_to_pay' => Format::moneyForDatabase($faker->numberBetween(6_000, 8_000)),
            'reserved_date' => $faker->date(),
        ];
    }
}

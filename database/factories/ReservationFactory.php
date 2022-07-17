<?php

namespace Database\Factories;

use App\Facades\Format;
use App\Models\Accommodation;
use App\Models\Package;
use App\Models\User;
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
            'accommodation_id' => Accommodation::inRandomOrder()->pluck('id')->first(),
            'package_id' => Package::inRandomOrder()->pluck('id')->first(),
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->pluck('id')->first(),
            'no_of_people' => $this->faker->numberBetween(20, 30),
            'amount_to_pay' => Format::moneyForDatabase($this->faker->numberBetween(6_000, 8_000)),
            'mode_of_payment' => 'cash',
            'reserved_date' => $this->faker->date(),
        ];
    }
}

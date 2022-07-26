<?php

namespace Database\Factories;

use App\Facades\Format;
use App\Models\Accommodation;
use App\Models\Package;
use App\Models\Status;
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
        $accommodation_id = Accommodation::inRandomOrder()->pluck('id')->first();
        $package_id = $accommodation_id == 5 ? /* Function Hall */
            1 : /* It is only available in the morning. */
            $this->faker->numberBetween(1, Package::count());

        return [
            'accommodation_id' => $accommodation_id,
            'package_id' => $package_id,
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->pluck('id')->first(),
            'status_id' => Status::all()->inRandomOrder()->pluck('id')->first(),
            'no_of_people' => $this->faker->numberBetween(20, 30),
            'amount_to_pay' => Format::moneyForDatabase($this->faker->numberBetween(6_000, 8_000)),
            'mode_of_payment' => 'Cash',
            'reserved_date' => $this->faker->date(),
        ];
    }
}

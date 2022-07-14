<?php

namespace Database\Seeders;

use App\Facades\Format;
use App\Models\Addon;
use App\Models\Package;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'package_id' => 1,
            'no_of_people' => 20,
            'amount_to_pay' => Format::moneyForDatabase(10_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-03-21'),
        ]);

        Reservation::create([
            'package_id' => 2,
            'no_of_people' => 28,
            // 13,000 + 3(100 per addt'l head)
            'amount_to_pay' => Format::moneyForDatabase(13_300),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-03-21'),
        ])->addons()->attach(1, ['quantity' => 3]);

        $addons = [
            1 => /* addt'l head */ ['quantity' => 5],
            2 => /* karaoke */ ['quantity' => 1],
        ];
        Reservation::create([
            'package_id' => 2,
            'no_of_people' => 30,
            // 13,000 + 5(100 per addt'l head) + 250 karaoke
            'amount_to_pay' => Format::moneyForDatabase(13_750),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-04-15'),
        ])->addons()->attach($addons);

        Reservation::create([
            'package_id' => 3,
            'no_of_people' => 30,
            'amount_to_pay' => Format::moneyForDatabase(25_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-02-13'),
        ]);

        $reservations = Reservation::factory()->count(10)->create();
        $additionalPeopleAddon = Addon::find(1);
        $karaokeAddon = Addon::find(2);
        foreach ($reservations as $reservation) {
            $package = Package::inRandomOrder()->first();
            $addons = [
                1 => /* addt'l head */ ['quantity' => rand(1, 5)],
                2 => /* karaoke */ ['quantity' => 1],
            ];

            $no_of_people = $package->max_people + $addons[1]['quantity'];
            $amount_to_pay = $package->rate
                + ($additionalPeopleAddon->rate * $addons[1]['quantity'])
                + $karaokeAddon->rate;
            
            $reservation->update([
                'no_of_people' => $no_of_people,
                'amount_to_pay' => $amount_to_pay,
            ]);
        }
    }
}

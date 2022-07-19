<?php

namespace Database\Seeders;

use App\Events\ReservationCreated;
use App\Facades\Format;
use App\Models\Accommodation;
use App\Models\Addon;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            'accommodation_id' => 1,
            'package_id' => 1,
            'user_id' => 2,
            'no_of_people' => 20,
            'amount_to_pay' => Format::moneyForDatabase(10_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-03-21'),
        ]);

        Reservation::create([
            'accommodation_id' => 1,
            'package_id' => 2,
            'user_id' => 3,
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
            'accommodation_id' => 1,
            'package_id' => 2,
            'user_id' => 4,
            'no_of_people' => 30,
            // 13,000 + 5(100 per addt'l head) + 250 karaoke
            'amount_to_pay' => Format::moneyForDatabase(13_750),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-04-15'),
        ])->addons()->attach($addons);

        Reservation::create([
            'accommodation_id' => 1,
            'package_id' => 3,
            'user_id' => 5,
            'no_of_people' => 30,
            'amount_to_pay' => Format::moneyForDatabase(25_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-02-13'),
        ]);

        $reservations = Reservation::factory()
                            ->count(46)
                            ->create();
        $additional_people_addon_rate = Addon::find(1)->pluck('rate')->first();
        $karaoke_addon_rate = Addon::find(2)->pluck('rate')->first();
        foreach ($reservations as $reservation) {
            // 1. Setup relationships.
            $package = Accommodation::find($reservation->accommodation_id)
                                    ->packages()
                                    ->wherePivot('package_id', $reservation->package_id)
                                    ->first();

            // 2. Check if $reservation exceeds the $pivot->max_people.
            $max_people = $package->pivot->max_people;
            $no_of_people = $reservation->no_of_people;
            $additional_head = max($no_of_people - $max_people, 0);

            // 3. Assign addons. Check if they should be add (quantity != 0) or not (unset from array).
            $addons = [
                1 => /* addt'l head */ ['quantity' => $additional_head],
                2 => /* karaoke */ ['quantity' => rand(0, 1)],
            ];

            // Some doest not exceed the 'max_people' limit.
            // $additional_people_addon_rate does not have to be assigned with 0
            // since $additional_head is 0 so their product will be 0 regardless.
            if ($additional_head == 0) unset($addons[1]);

            // Some do not add 'karaoke' in their reservation.
            if ($addons[2]['quantity'] == 0) {
                unset($addons[2]);
                $karaoke_addon_rate = 0;
            }

            // 4. Compute amount to pay.
            $amount_to_pay = $package->pivot->rate
                + ($additional_people_addon_rate * $additional_head)
                + $karaoke_addon_rate;

            // 5. Attach $addons if the array haven't unset every element.
            if ($addons != null) $reservation->addons()->attach($addons);
            
            // 6. Update the $resrvation row.
            $reservation->update([
                'no_of_people' => $no_of_people,
                'amount_to_pay' => $amount_to_pay,
            ]);
        }

        // Delete existing Qr Codes and Receipts in
        // `storage/images/receipts` prior to this seed.
        Storage::deleteDirectory('public/images/qr_codes');
        Storage::deleteDirectory('public/images/receipts');
        // Upload Qr Codes and receipts to 'storage/images/receipts`
        // and 'storage/images/receipts`, respectively.
        Reservation::all()->each(function ($item, $key) {
            $qr_code_path = asset("storage/images/qr_codes/{$item->transaction_no}.png");
            $receipt_path = asset("storage/images/receipts/{$item->transaction_no}.pdf");
            $item->update([
                'qr_code_path' => $qr_code_path,
                'receipt_path' => $receipt_path,
            ]);
            event(new ReservationCreated($item));
        });
    }
}

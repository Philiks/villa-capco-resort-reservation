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
            'status_id' => 4,
            'no_of_people' => 20,
            'amount_to_pay' => Format::moneyForDatabase(10_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-03-21'),
        ]);

        Reservation::create([
            'accommodation_id' => 1,
            'package_id' => 2,
            'user_id' => 3,
            'status_id' => 4,
            'no_of_people' => 28,
            // 13,000 + 3(100 per addt'l head)
            'amount_to_pay' => Format::moneyForDatabase(13_300),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-03-21'),
        ])->addons()->attach(4, ['quantity' => 3]);

        $addons = [
            3 => /* karaoke */ ['quantity' => 1],
            4 => /* addt'l head */ ['quantity' => 5],
        ];
        Reservation::create([
            'accommodation_id' => 1,
            'package_id' => 2,
            'user_id' => 4,
            'status_id' => 4,
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
            'status_id' => 4,
            'no_of_people' => 30,
            'amount_to_pay' => Format::moneyForDatabase(25_000),
            'mode_of_payment' => 'cash',
            'reserved_date' => Carbon::parse('2022-02-13'),
        ]);

        $reservations = Reservation::factory()
                            ->count(46)
                            ->create();

        foreach ($reservations as $reservation)
            $this->updateReservation($reservation);

        // Delete existing Qr Codes and Receipts in
        // `storage/images/receipts` prior to this seed.
        Storage::disk('public')->deleteDirectory(Reservation::QR_CODE_PATH);
        Storage::disk('public')->deleteDirectory(Reservation::RECEIPT_PATH);
        // Upload Qr Codes and receipts to 'storage/images/receipts`
        // and 'storage/images/receipts`, respectively.
        Reservation::all()->each(function ($item, $key) {
            $qr_code_path = Reservation::getQrCodeFilepathFor($item->transaction_no);
            $receipt_path = Reservation::getReceiptFilepathFor($item->transaction_no);
            $item->update([
                'qr_code_path' => $qr_code_path,
                'receipt_path' => $receipt_path,
            ]);
            event(new ReservationCreated($item));
        });
    }

    private function updateReservation($reservation)
    {
        // 1. Setup relationships.
        $package = Accommodation::find($reservation->accommodation_id)
                                ->packages()
                                ->wherePivot('package_id', $reservation->package_id)
                                ->first();

        // 2. Check if $reservation exceeds the $pivot->max_people.
        $max_people = $package->pivot->max_people;
        $no_of_people = $reservation->no_of_people;
        $additional_head = max($no_of_people - $max_people, 0);

        // 3. Assign addons. Check if they should be added (quantity != 0) or not (unset from array).
        $addons_quantities = Addon::all()->mapWithKeys(fn ($item) => [
            $item['id'] => [ 
                'quantity' => $item['name'] == "Additional Person" ? $additional_head : rand(0, 1),
                'rate' => $item['rate'],
            ]
        ])->filter(fn ($value) => $value['quantity'] > 0);

        // 4 Compute for the accumulated addons rate and the package's rate.
        $amount_to_pay = $addons_quantities
            ->reduce(fn ($carry, $current) => $carry + $current['quantity'] * $current['rate'],
                $package->pivot->rate /* The initial value is the package's rate. */);

        // 5. Convert the collection to array and attach to the reservation if it is not empty.
        $addons_quantities = $addons_quantities->map(fn ($item) => [ 'quantity' => $item['quantity'] ])->toArray();
        if ($addons_quantities != null) $reservation->addons()->attach($addons_quantities);
        
        // 6. Update the $resrvation row.
        $reservation->update([
            'no_of_people' => $no_of_people,
            'amount_to_pay' => $amount_to_pay,
        ]);
    }
}

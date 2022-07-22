<?php

namespace App\Services;

use App\Models\Accommodation;
use App\Models\Reservation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Receipt
{
    /**
     * Generate Qr Code that links to the url of the receipt.\
     * The Qr Code will be located at images/qr_codes/<transaction_no>.png
     * 
     * @param string $transaction_no The primary key of the `Reservation` model.
     */
    public function generateQrCode(string $transaction_no): void {
        $qr_code_path = Reservation::getQrCodePublicPathFor($transaction_no);
        $receipt_path = Reservation::getReceiptServerPathFor($transaction_no);
        
        $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl={$receipt_path}";
        $content = file_get_contents($url);
        Storage::put($qr_code_path, $content);
    }

    /**
     * Generate/update Receipt using the instance of the Reservation.\
     * Receipt should be updated once a change in reservation record occurs.\
     * Qr code should not be updated as it only points to the link of the receipt.\
     * The Receipt will be located at images/receipts/<transaction_no>.png
     * 
     * @param \App\Models\Reservation $reservation The model instance of `Reservation`.
     */
    public function generateReceipt(Reservation $reservation): void {
        $user = User::find($reservation->user_id);
        $accommodation = Accommodation::find($reservation->accommodation_id);
        $package = $accommodation->packages()
                                 ->wherePivot('package_id', $reservation->package_id)
                                 ->first();
        
        $addons = $reservation->addons()
                    ->get()
                    ->map(fn ($item, $key) => [
                        'name' => $item->name,
                        'rate' => $item->rate,
                        'quantity' => $item->pivot->quantity,
                        'subtotal' => $item->pivot->quantity * $item->rate
                    ])
                    ->toArray();

        $receipt = [
            'transaction_no' => $reservation->transaction_no,
            'qr_code_path' => $reservation->qr_code_path,
            'user_fullname' => $user->getFullname(),
            'user_contact_no' => $user->contact_number,
            'user_email' => $user->email,
            'no_of_people' => $reservation->no_of_people,
            'reserved_date' => $reservation->reserved_date,
            'start_time' => $package->start_time,
            'end_time' => $package->end_time,
            'mode_of_payment' => $reservation->mode_of_payment,
            'accommodation' => $accommodation->name,
            'package' => $package->name,
            'rate' => $package->pivot->rate,
            'max_people' => $package->pivot->max_people,
            'addons' => $addons,
            'amount_to_pay' => $reservation->amount_to_pay,
        ];
        
        $pdf = Pdf::loadView('pdf.receipt', compact("receipt"));
        $receipt_path = Reservation::getReceiptPublicPathFor($reservation->transaction_no);
        Storage::put($receipt_path, $pdf->output());
    }

    /**
     * Deletes the qr code and receipt from the storage folder.\
     * This must comes after the deletion of the record in the database.
     * 
     * @param string $transaction_no Name of the file.
     */
    public function deleteQrCodeAndReceipt(string $transaction_no): void {
        $qr_code_path = Reservation::getQrCodePublicPathFor($transaction_no);
        $receipt_path = Reservation::getReceiptPublicPathFor($transaction_no);
        Storage::delete([$qr_code_path, $receipt_path]);
    }
}
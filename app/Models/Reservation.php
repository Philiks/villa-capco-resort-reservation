<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The public path of qr code.
     * 
     * @var string
     */
    public const QR_CODE_PATH = "images/qr_codes/";

    /**
     * The public path of receipt.
     * 
     * @var string
     */
    public const RECEIPT_PATH = "images/receipts/";

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_no';

    /**
     * The "type" of the primary key ID.
     * Illuminate\Support\Str::uuid()->toString()
     * has a type of string.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Bootstrap the model and its traits.
     * 
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Create the primary key UUID.
         */
        static::creating(function ($reservations) {
            $reservations->{$reservations->getKeyName()} = Str::uuid()->toString();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_of_people',
        'amount_to_pay',
        'mode_of_payment',
        'reserved_date',
        'qr_code_path',
        'receipt_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'no_of_people' => 'integer',
        'amount_to_pay' => 'integer',
        'reserved_date' => 'date',
    ];

    /**
     * Addons that belong to the Reservation.
     */
    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class)
            ->withTimestamps()
            ->withPivot(['quantity']);
    }

    /**
     * Get the Accommodation that owns the Reservation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    /**
     * Get the Package that owns the Reservation.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the User that owns the Reservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the full path of the qr code given its transaction_no.\
     * This path is used for saving the file using the `Storage::put()`.
     * 
     * @param string $transaction_no Name of the file.
     * @return string full path of the qr code.
     */
    public static function getQrCodePublicPathFor(string $transaction_no): string {
        return 'public/' . Reservation::QR_CODE_PATH . $transaction_no . '.png';
    }

    /**
     * Returns the full path of the receipt given its transaction_no.\
     * This path is used for saving the file using the `Storage::put()`.
     * 
     * @param string $transaction_no Name of the file.
     * @return string full path of the receipt.
     */
    public static function getReceiptPublicPathFor(string $transaction_no): string {
        return 'public/' . Reservation::RECEIPT_PATH . $transaction_no . '.pdf';
    }

    /**
     * Returns the server path of the qr code given its transaction_no.\
     * This path is used to save the `asset()` path of the transaction in the database.
     * 
     * @param string $transaction_no Name of the file.
     * @return string server path of the qr code.
     */
    public static function getQrCodeServerPathFor(string $transaction_no): string {
        return asset('storage/' . Reservation::QR_CODE_PATH . $transaction_no . '.png');
    }

    /**
     * Returns the full path of the receipt given its transaction_no.\
     * This path is used to save the `asset()` path of the transaction in the database.
     * 
     * @param string $transaction_no Name of the file.
     * @return string server path of the receipt.
     */
    public static function getReceiptServerPathFor(string $transaction_no): string {
        return asset('storage/' . Reservation::RECEIPT_PATH . $transaction_no . '.pdf');
    }
}

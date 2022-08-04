<?php

use App\Models\Accommodation;
use App\Models\Package;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('transaction_no');
            $table->foreignIdFor(Accommodation::class);
            $table->foreignIdFor(Package::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Status::class);
            $table->tinyInteger('no_of_people');
            $table->integer('amount_to_pay')
                  ->comment('Divide by 100 to get the exact amount in decimal value.');
            $table->string('mode_of_payment');
            $table->datetime('reserved_date')
                  ->nullable()
                  ->comment('Null reserved_date means the status_id is \'Cancelled\'.');
            $table->string('qr_code_path')
                  ->nullable()
                  ->comment('Qr Code will be made after the transaction_no has been created.');
            $table->string('receipt_path')
                  ->nullable()
                  ->comment('Receipt will be made after the qr code has been created.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};


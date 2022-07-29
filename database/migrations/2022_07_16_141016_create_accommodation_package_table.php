<?php

use App\Models\Accommodation;
use App\Models\Package;
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
        Schema::create('accommodation_package', function (Blueprint $table) {
            $table->foreignIdFor(Accommodation::class);
            $table->foreignIdFor(Package::class);
            $table->integer('rate')
                  ->comment('Divide by 100 to get the exact amount in decimal value.');
            $table->tinyInteger('max_people');
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
        Schema::dropIfExists('accommodation_package');
    }
};

<?php

namespace App\Providers;

use App\Services\Receipt;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ReceiptServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('receipt', function() {
            return new Receipt();
        });
    }
}

<?php

namespace App\Providers;

use App\Services\Format;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FormatServiceProvider extends ServiceProvider
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
        App::bind('format', function() {
            return new Format();
        });
    }
}

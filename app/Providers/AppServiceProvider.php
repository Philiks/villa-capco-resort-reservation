<?php

namespace App\Providers;

use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\Column;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Column::configureUsing(function (Column $column): void {
            $column
                ->toggleable()
                ->sortable();
        });

        BooleanColumn::configureUsing(function (Column $column): void {
            $column->extraAttributes(['class' => 'flex justify-center']);
        });
    }
}

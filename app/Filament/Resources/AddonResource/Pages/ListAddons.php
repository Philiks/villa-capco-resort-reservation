<?php

namespace App\Filament\Resources\AddonResource\Pages;

use App\Filament\Resources\AddonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAddons extends ListRecords
{
    protected static string $resource = AddonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

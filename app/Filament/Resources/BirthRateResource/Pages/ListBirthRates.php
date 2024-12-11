<?php

namespace App\Filament\Resources\BirthRateResource\Pages;

use App\Filament\Resources\BirthRateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBirthRates extends ListRecords
{
    protected static string $resource = BirthRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

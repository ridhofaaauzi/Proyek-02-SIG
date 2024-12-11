<?php

namespace App\Filament\Resources\DistrictDataResource\Pages;

use App\Filament\Resources\DistrictDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistrictData extends ListRecords
{
    protected static string $resource = DistrictDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

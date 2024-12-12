<?php

namespace App\Filament\Resources\BirthRateResource\Pages;

use App\Filament\Resources\BirthRateResource;
use App\Helpers\ModelLabelHelper;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBirthRates extends ListRecords
{
    protected static string $resource = BirthRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('New ') . ModelLabelHelper::translateModelLabel(self::getModel())),
        ];
    }
}

<?php

namespace App\Filament\Resources\BirthRateResource\Pages;

use App\Filament\Resources\BirthRateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBirthRate extends EditRecord
{
    protected static string $resource = BirthRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

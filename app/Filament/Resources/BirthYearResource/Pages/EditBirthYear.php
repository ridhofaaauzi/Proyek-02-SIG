<?php

namespace App\Filament\Resources\BirthYearResource\Pages;

use App\Filament\Resources\BirthYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBirthYear extends EditRecord
{
    protected static string $resource = BirthYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

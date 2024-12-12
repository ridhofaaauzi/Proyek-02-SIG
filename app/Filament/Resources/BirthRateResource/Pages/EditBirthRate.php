<?php

namespace App\Filament\Resources\BirthRateResource\Pages;

use App\Filament\Resources\BirthRateResource;
use App\Helpers\ModelLabelHelper;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBirthRate extends EditRecord
{
    protected static string $resource = BirthRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label(__('Delete ') . ModelLabelHelper::translateModelLabel(self::getModel())),
        ];
    }
}

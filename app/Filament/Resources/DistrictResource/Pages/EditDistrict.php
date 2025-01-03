<?php

namespace App\Filament\Resources\DistrictResource\Pages;

use App\Filament\Resources\DistrictResource;
use App\Helpers\ModelLabelHelper;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistrict extends EditRecord
{
    protected static string $resource = DistrictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label(__('Delete ') . ModelLabelHelper::translateModelLabel(self::getModel())),
        ];
    }
}

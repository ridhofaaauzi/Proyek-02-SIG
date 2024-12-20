<?php

namespace App\Filament\Resources\DistrictDataResource\Pages;

use App\Filament\Resources\DistrictDataResource;
use App\Helpers\ModelLabelHelper;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistrictData extends EditRecord
{
    protected static string $resource = DistrictDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label(__('Delete ') . ModelLabelHelper::translateModelLabel(self::getModel())),
        ];
    }

    public function getHeading(): string
    {
        return __('Edit District Data');
    }
}

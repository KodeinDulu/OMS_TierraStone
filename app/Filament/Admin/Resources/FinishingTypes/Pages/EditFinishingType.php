<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Pages;

use App\Filament\Admin\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinishingType extends EditRecord
{
    protected static string $resource = FinishingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

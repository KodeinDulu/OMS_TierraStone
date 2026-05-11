<?php

namespace App\Filament\Mandor\Resources\FinishingTypes\Pages;

use App\Filament\Mandor\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinishingType extends EditRecord
{
    protected static string $resource = FinishingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

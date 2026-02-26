<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Pages;

use App\Filament\Admin\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinishingTypes extends ListRecords
{
    protected static string $resource = FinishingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

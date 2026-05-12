<?php

namespace App\Filament\Mandor\Resources\FinishingTypes\Pages;

use App\Filament\Mandor\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinishingTypes extends ListRecords
{
    protected static string $resource = FinishingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}

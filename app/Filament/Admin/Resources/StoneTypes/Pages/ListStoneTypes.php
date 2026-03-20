<?php

namespace App\Filament\Admin\Resources\StoneTypes\Pages;

use App\Filament\Admin\Resources\StoneTypes\StoneTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStoneTypes extends ListRecords
{
    protected static string $resource = StoneTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

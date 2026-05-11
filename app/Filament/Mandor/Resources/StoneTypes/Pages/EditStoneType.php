<?php

namespace App\Filament\Mandor\Resources\StoneTypes\Pages;

use App\Filament\Mandor\Resources\StoneTypes\StoneTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStoneType extends EditRecord
{
    protected static string $resource = StoneTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

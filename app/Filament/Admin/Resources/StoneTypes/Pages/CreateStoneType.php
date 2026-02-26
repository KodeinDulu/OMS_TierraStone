<?php

namespace App\Filament\Admin\Resources\StoneTypes\Pages;

use App\Filament\Admin\Resources\StoneTypes\StoneTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStoneType extends CreateRecord
{
    protected static string $resource = StoneTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

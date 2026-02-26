<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Pages;

use App\Filament\Admin\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFinishingType extends CreateRecord
{
    protected static string $resource = FinishingTypeResource::class;
}

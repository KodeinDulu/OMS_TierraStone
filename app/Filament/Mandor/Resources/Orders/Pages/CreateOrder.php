<?php

namespace App\Filament\Mandor\Resources\Orders\Pages;

use App\Filament\Mandor\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}

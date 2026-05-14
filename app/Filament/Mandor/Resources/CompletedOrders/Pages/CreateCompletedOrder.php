<?php

namespace App\Filament\Mandor\Resources\CompletedOrders\Pages;

use App\Filament\Mandor\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompletedOrder extends CreateRecord
{
    protected static string $resource = CompletedOrderResource::class;
}

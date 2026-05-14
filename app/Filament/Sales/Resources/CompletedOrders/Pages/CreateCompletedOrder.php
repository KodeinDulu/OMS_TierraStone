<?php

namespace App\Filament\Sales\Resources\CompletedOrders\Pages;

use App\Filament\Sales\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompletedOrder extends CreateRecord
{
    protected static string $resource = CompletedOrderResource::class;
}

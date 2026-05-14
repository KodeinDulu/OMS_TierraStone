<?php

namespace App\Filament\Admin\Resources\CompletedOrders\Pages;

use App\Filament\Admin\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompletedOrder extends CreateRecord
{
    protected static string $resource = CompletedOrderResource::class;
}

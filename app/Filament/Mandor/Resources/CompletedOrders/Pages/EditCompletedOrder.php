<?php

namespace App\Filament\Mandor\Resources\CompletedOrders\Pages;

use App\Filament\Mandor\Resources\CompletedOrders\CompletedOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompletedOrder extends EditRecord
{
    protected static string $resource = CompletedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
        ];
    }
}

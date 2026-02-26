<?php

namespace App\Filament\Sales\Resources\Orders\Pages;

use App\Filament\Sales\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $order = $this->record;

        // track who last updated
        $order->updateQuietly(['updated_by' => auth()->id()]);
    }
}

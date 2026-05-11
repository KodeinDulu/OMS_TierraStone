<?php

namespace App\Filament\Mandor\Resources\Orders\Pages;

use App\Filament\Mandor\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        $this->record->updateQuietly(['updated_by' => auth()->id()]);

        $order = $this->record;

        if ($order->wasChanged('status')) {
            $order->updateQuietly([
                'completed_at' => in_array($order->status, ['done', 'rejected'])
                    ? now()
                    : null,
            ]);
        }
    }
}

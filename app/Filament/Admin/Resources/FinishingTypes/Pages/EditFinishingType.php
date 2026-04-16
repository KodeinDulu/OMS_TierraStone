<?php

namespace App\Filament\Admin\Resources\FinishingTypes\Pages;

use App\Filament\Admin\Resources\FinishingTypes\FinishingTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditFinishingType extends EditRecord
{
    protected static string $resource = FinishingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->before(function ($record, $action) {
                        if ($record->orderItems()->exists()) {
                            Notification::make()
                                ->title('Tidak bisa dihapus')
                                ->body('Jenis finishing ini sudah digunakan dalam pesanan.')
                                ->danger()
                                ->send();

                            $action->halt();
                        }
                    }),
        ];
    }
}

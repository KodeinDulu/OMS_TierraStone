<?php

namespace App\Filament\Admin\Resources\StoneTypes\Pages;

use App\Filament\Admin\Resources\StoneTypes\StoneTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditStoneType extends EditRecord
{
    protected static string $resource = StoneTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->before(function ($record, $action) {
                        if ($record->orderItems()->exists()) {
                            Notification::make()
                                ->title('Tidak bisa dihapus')
                                ->body('Jenis batu ini sudah digunakan dalam pesanan.')
                                ->danger()
                                ->send();

                            $action->halt();
                        }
                    }),
        ];
    }
}

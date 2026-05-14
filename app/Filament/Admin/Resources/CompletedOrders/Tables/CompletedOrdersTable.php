<?php

namespace App\Filament\Admin\Resources\CompletedOrders\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class CompletedOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')->searchable(),
                TextColumn::make('customer_name')->searchable(),
                TextColumn::make('sales.name')->label('Sales'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'done'     => 'success',
                        'rejected' => 'danger',
                        default    => 'gray',
                    }),
                TextColumn::make('completed_at')
                    ->label('Selesai Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('completed_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'done'     => 'Done',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}

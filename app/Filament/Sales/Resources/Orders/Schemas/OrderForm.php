<?php

namespace App\Filament\Sales\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

use App\Models\StoneType;
use App\Models\FinishingType;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_code')
                    ->label('Kode Pesanan')
                    ->disabled(), // read-only, auto-generated

                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->disabled(fn () => auth()->user()->hasRole('mandor')),

                TextInput::make('customer_phone')
                ->label('No. Telepon')
                ->disabled(fn () => auth()->user()->hasRole('mandor')),

                TextInput::make('customer_email')->email()
                ->label('Email')
                ->disabled(fn () => auth()->user()->hasRole('mandor')),

                Select::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending'     => 'Pending',
                        'on_hold'     => 'On Hold',
                        'on_progress' => 'On Progress',
                        'finished'    => 'Finished',
                        'rejected'    => 'Rejected',
                    ])
                    ->required(),

                Textarea::make('notes')
                ->label('Catatan Tambahan'),

                Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        Select::make('stone_type_id')
                            ->label('Jenis Batu')
                            ->options(
                                StoneType::where('is_available', true)
                                    ->pluck('name', 'id')
                            )
                            ->required(),

                        Select::make('finishing')
                            ->label('Finishing')
                            ->options(
                                FinishingType::where('is_available', true)->pluck('name', 'name')
                            )
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('finishing')
                                    ->label('Custom Finishing')
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data): string {
                                return $data['finishing'];
                            })
                            ->required(),

                        TextInput::make('width')
                            ->label('Lebar')
                            ->numeric()
                            ->required(),

                        TextInput::make('height')
                            ->label('Tinggi')
                            ->numeric()
                            ->required(),

                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2)
                    ->required()
                    ->disabled(fn () => auth()->user()->hasRole('mandor')),
            ]);
    }
}

<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

use App\Models\StoneType;

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
                    ->required(),

                TextInput::make('customer_phone')
                ->label('No. Telepon'),

                TextInput::make('customer_email')->email()
                ->label('Email'),

                Select::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending'     => 'Pending',
                        'on_hold'     => 'On Hold',
                        'on_progress' => 'On Progress',
                        'finished'    => 'Finished',
                        'rejected'    => 'Rejected',
                    ])
                    ->default('pending')
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

                        TextInput::make('finishing')
                            ->label('Finishing')
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
                    ->columns(2),
            ]);
    }
}

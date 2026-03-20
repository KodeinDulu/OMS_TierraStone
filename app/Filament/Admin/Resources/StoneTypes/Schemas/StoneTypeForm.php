<?php

namespace App\Filament\Admin\Resources\StoneTypes\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class StoneTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Batu')
                ->description('Data utama jenis batu yang tersedia.')
                ->icon('heroicon-o-cube')
                ->iconColor('warning')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Jenis Batu')
                        ->required()
                        ->placeholder('Contoh: Granit, Marmer, Andesit...')
                        ->prefixIcon('heroicon-o-tag'),

                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->placeholder('Contoh: Batu alam dengan tekstur kasar, cocok untuk eksterior...')
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Foto & Ketersediaan')
                ->description('Upload foto referensi dan atur ketersediaan batu.')
                ->icon('heroicon-o-photo')
                ->iconColor('info')
                ->schema([
                    FileUpload::make('reference_image')
                        ->label('Foto Batu')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('stone-types')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format: JPG, PNG, WEBP. Maksimal 2MB.')
                        ->columnSpanFull(),

                    Toggle::make('is_available')
                        ->label('Tersedia untuk Pemesanan')
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger')
                        ->columnSpanFull(),
                ]),
        ]);
    }
}

<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Akun')
                ->description('Data akun untuk login ke sistem.')
                ->icon('heroicon-o-user-circle')
                ->iconColor('primary')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->prefixIcon('heroicon-o-user'),
                TextInput::make('email')
                ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->prefixIcon('heroicon-o-envelope'),

                    TextInput::make('password')
                        ->label(fn (string $operation) => $operation === 'edit' ? 'Password Baru (opsional)' : 'Password')
                        ->password()
                        ->revealable()  // toggle show/hide password
                        ->prefixIcon('heroicon-o-lock-closed')
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->required(fn (string $operation) => $operation === 'create')
                        ->placeholder('Minimal 8 karakter'),
                ])->columns(2),

            Section::make('Hak Akses')
                ->description('Tentukan role dan akses pengguna di sistem.')
                ->icon('heroicon-o-shield-check')
                ->iconColor('warning')
                ->schema([
                    Select::make('role')
                        ->label('Role')
                        ->options([
                            'admin'  => 'Admin',
                            'sales'  => 'Sales',
                            'mandor' => 'Mandor',
                        ])
                        ->required()
                        ->native(false)
                        ->prefixIcon('heroicon-o-identification')
                        ->dehydrated(false),
                ]),
        ]);
    }
}

<?php

namespace App\Filament\Mandor\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{

    protected static string $routePath = '/';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return 'Dashboard Mandor';
    }
}

<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{

    // custom dashboard route path so that not conflicted with the default dashboard route of Filament
    protected static string $routePath = '/';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
{
    return 'Dashboard Admin';
}

}

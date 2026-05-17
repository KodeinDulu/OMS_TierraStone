<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Mandor\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\MandorPanelMiddleware;

class MandorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('mandor')
            ->path('mandor')
            ->brandName('Tierra Stone - Mandol Panel')
            ->profile()
            ->login()
            ->authGuard('web')
            ->registration(false)
            ->resources([
                \App\Filament\Mandor\Resources\Orders\OrderResource::class,
                \App\Filament\Mandor\Resources\CompletedOrders\CompletedOrderResource::class,
                \App\Filament\Mandor\Resources\StoneTypes\StoneTypeResource::class,
                \App\Filament\Mandor\Resources\FinishingTypes\FinishingTypeResource::class,
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Mandor/Resources'), for: 'App\Filament\Mandor\Resources')
            // ->discoverPages(in: app_path('Filament/Mandor/Pages'), for: 'App\Filament\Mandor\Pages')
            ->pages([
                \App\Filament\Mandor\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Mandor/Widgets'), for: 'App\Filament\Mandor\Widgets')
            ->widgets([
                AccountWidget::class,
                \App\Filament\Sales\Widgets\SalesDashboard::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                MandorPanelMiddleware::class,
            ]);
    }
}

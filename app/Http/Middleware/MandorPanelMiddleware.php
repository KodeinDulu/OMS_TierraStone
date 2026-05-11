<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Notifications\Notification;

class MandorPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->hasAnyRole(['mandor', 'admin'])) {
            return $next($request);
        }

        Notification::make()
            ->title('403 - Forbidden')
            ->body('You do not have access to Mandor panel.')
            ->danger()
            ->send();

        return redirect('/');
    }
}

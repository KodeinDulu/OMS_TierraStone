<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Notifications\Notification;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (!auth()->user()->hasRole('admin')) {
            Notification::make()
                ->title('403 - Forbidden')
                ->body('You do not have access to Admin panel.')
                ->danger()
                ->send();

            if (auth()->user()->hasRole('sales')) {
                return redirect('/sales');
            }

             if (auth()->user()->hasRole('mandor')) {
                return redirect('/mandor');

            }

            return redirect('/');
        }

        return $next($request);
    }
}

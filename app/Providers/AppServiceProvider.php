<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    
        Schema::defaultStringLength(191);
    
        // Chargement des routes admin
        Route::middleware(['web', 'auth', 'admin']) // ou 'isAdmin' si c'est le nom de ton middleware
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));


         View::composer('layouts.member', function ($view) {
        if (Auth::check()) {
            $messages = Message::with('sender')
                        ->where('receiver_id', Auth::id()) // adapte ce champ
                        ->latest()
                        ->take(5)
                        ->get();

            $view->with('messages', $messages);
        }
    });
    View::composer('layouts.admin', function ($view) {
        if (Auth::check()) {
            $messages = Message::with('sender')
                        ->where('receiver_id', Auth::id()) // adapte ce champ
                        ->latest()
                        ->take(5)
                        ->get();

            $view->with('messages', $messages);
        }
    });
    }
    
}

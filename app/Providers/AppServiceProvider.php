<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

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
    }
    
}

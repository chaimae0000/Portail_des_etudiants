<?php
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;
use App\Http\Controllers\Admin\AdherantController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    // Routes protégées par les middlewares auth et admin
    Route::resource('admin/events', EventController::class); // Gestion des événements

    // Autres routes admin
   
    
    Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');
    Route::get('/admin/dashboard/events/list/show', [EventController::class, 'index'])->name('events.show');

    // Autres routes espace
    Route::get('/espace', [Espace::class, 'index'])->name('espace');
    Route::get('/gestion_adherants/visualiser-adherants', [Espace::class, 'visualiserAdherants'])->name('visualiser_adherants');
    Route::get('/messages', [Espace::class, 'messages'])->name('messages');
});
Route::middleware(['auth', 'IsAdmin'])->get('/admin-test', function () {
    return 'Vous avez accès à la page admin';
});

Route::get('/admin/dashboard/events/list', [EventController::class, 'index'])->name('events.list');
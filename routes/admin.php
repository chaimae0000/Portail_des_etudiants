<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;
use App\Http\Controllers\Admin\AdherantController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('/events', EventController::class)->names([
        'index' => 'admin.events.index',
        'store' => 'admin.events.store',
        'show' => 'admin.events.show',
        
    ]);
});
// Route pour afficher le formulaire de modification
Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');

// Route pour mettre à jour l'événement
Route::put('/admin/events/{id}', [EventController::class, 'update'])->name('admin.events.update');

Route::delete('/admin/events/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');

Route::get('/admin/dashboard/events/list', [EventController::class, 'index'])->name('events.list');
Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');

Route::middleware(['auth', IsAdmin::class])->group(function () {
        
    Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');

    // Autres routes espace
    Route::get('/espace', [Espace::class, 'index'])->name('espace');
    Route::get('/gestion_adherants/visualiser-adherants', [AdherantController::class, 'index'])->name('visualiser_adherants');

    Route::get('/messages', [Espace::class, 'messages'])->name('messages');
   
    Route::post('/admin/adherants/store', [AdherantController::class, 'store'])->name('adherants.store');

    Route::get('/admin/adherants/{id}', [AdherantController::class, 'show'])->name('adherants.show');
Route::put('/admin/adherants/{id}', [AdherantController::class, 'update'])->name('adherants.update');
Route::delete('/admin/adherants/{id}', [AdherantController::class, 'destroy'])->name('adherants.destroy');


    
    
    
    
});
Route::middleware(['auth', 'IsAdmin'])->get('/admin-test', function () {
    return 'Vous avez accès à la page admin';
});

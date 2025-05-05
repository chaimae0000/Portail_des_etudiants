<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;
use App\Http\Controllers\Admin\AdherantController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Str;
Route::resource('events', EventController::class);


/**Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
});*/


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/events', EventController::class);
});




Route::get('/admin/dashboard/events/list', [EventController::class, 'index'])->name('events.list');
Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');
Route::get('/admin/dashboard/events/list/show', [EventController::class, 'index'])->name('events.show');
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', IsAdmin::class])->group(function () {
    // Routes protégées par les middlewares auth et admin
    Route::resource('admin/events', EventController::class); // Gestion des événements

    // Autres routes admin
   
    
    Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');
    Route::get('/admin/dashboard/events/list/show', [EventController::class, 'index'])->name('events.show');

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

Route::get('/admin/dashboard/events/list', [EventController::class, 'index'])->name('events.list');
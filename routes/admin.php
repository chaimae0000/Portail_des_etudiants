<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;
use App\Http\Controllers\Admin\AdherantController;
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
use App\Http\Middleware\IsAdmin;

// Route pour soumettre le formulaire et créer un événement
//Route::post('/admin/events', [EventController::class, 'store'])->name('admin.events.store');
Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');


    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('/espace', [Espace::class, 'index'])->name('espace');
    Route::get('/gestion_adherants/visualiser-adherants', [Espace::class, 'visualiserAdherants'])->name('visualiser_adherants');
    Route::get('/messages', [Espace::class, 'messages'])->name('messages');
    Route::resource('/events', EventController::class);
    
    });
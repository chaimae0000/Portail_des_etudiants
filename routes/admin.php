<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AdherantController;
Route::resource('events', EventController::class);


/**Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
});*/


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/events', EventController::class);
});



Route::get('/admin/gestion_adherants/visualiser-adherants', [AdherantController::class, 'index'])->name('gestion_adherants.visualiser_adherants');



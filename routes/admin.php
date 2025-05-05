<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AdherantController;
use Illuminate\Support\Str;
Route::resource('events', EventController::class);


/**Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
});*/


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/events', EventController::class);
});



Route::get('/admin/gestion_adherants/visualiser-adherants', [AdherantController::class, 'index'])->name('gestion_adherants.visualiser_adherants');

Route::get('/admin/dashboard/events/list', [EventController::class, 'index'])->name('events.list');
Route::get('/admin/setting', [EventController::class, 'index'])->name('setting');
Route::get('/admin/dashboard/events/list/show', [EventController::class, 'index'])->name('events.show');


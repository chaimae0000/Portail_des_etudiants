<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;

Route::resource('events', EventController::class);


/**Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
});*/


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/events', EventController::class);
});

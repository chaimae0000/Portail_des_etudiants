<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;
use App\Http\Controllers\Admin\AdherantController;
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;


 

    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('/espace', [Espace::class, 'index'])->name('espace');
    Route::get('/gestion_adherants/visualiser-adherants', [Espace::class, 'visualiserAdherants'])->name('visualiser_adherants');
    Route::get('/messages', [Espace::class, 'messages'])->name('messages');
    Route::resource('/events', EventController::class);
    
    });
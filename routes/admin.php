<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\Espace;


use App\Http\Controllers\Admin\AdherantController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\MessageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;


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

    Route::get('/admin/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages');
Route::post('/admin/messages/{id}/reply', [App\Http\Controllers\Admin\MessageController::class, 'reply'])->name('messages.reply');

   
    Route::post('/admin/adherants/store', [AdherantController::class, 'store'])->name('adherants.store');

    Route::get('/admin/adherants/{id}', [AdherantController::class, 'show'])->name('adherants.show');
    Route::put('/admin/adherants/{id}', [AdherantController::class, 'update'])->name('adherants.update');
    Route::delete('/admin/adherants/{id}', [AdherantController::class, 'destroy'])->name('adherants.destroy');


    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    
    
    
});
Route::middleware(['auth', 'IsAdmin'])->get('/admin-test', function () {
    return 'Vous avez accès à la page admin';
});
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('posts.update');
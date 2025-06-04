<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Membre\EventController;
use App\Http\Controllers\Membre\MessageController;
use App\Http\Controllers\Membre\ProfileController;
use App\Http\Middleware\IsMembre;
use App\Http\Controllers\Membre\PostController;
use App\Http\Controllers\Membre\EspaceController;
use App\Http\Controllers\Membre\DashboardController;

Route::prefix('membre')->middleware(['auth', IsMembre::class])->name('membre.')->group(function () {

    Route::resource('events', EventController::class);
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/comment', [PostController::class, 'comment'])->name('posts.comment');

    Route::get('/espace', [EspaceController::class, 'index'])->name('espace');

    // Messages : afficher la conversation avec l’admin
Route::get('/messages', [MessageController::class, 'msgs'])->name('messages.msgs');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');




    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/evenements', [EventController::class, 'index'])->name('events.index');
    Route::post('/evenements/{event}/participer', [EventController::class, 'participer'])->name('events.participer');
    Route::get('/membre/mes-evenements', [EventController::class, 'mesEvenements'])->name('evenements');




});

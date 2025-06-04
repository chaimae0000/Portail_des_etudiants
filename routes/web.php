<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdherantController;






Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    // Afficher la liste des adhérents
    Route::get('/gestion_adherants/visualiser-adherants', [AdherantController::class, 'index'])->name('visualiser_adherants');
});

// Regular profile route for authenticated users
// Admin route with the IsAdmin middleware, prefixed with 'admin'
// Routes for displaying, editing, updating, and deleting the profile


Route::get('/', [HomeController::class, 'index']);



// Still let Breeze handle POST login/register
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-submit', [HomeController::class, 'submitLogin'])->name('login.submit');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/storeRegister', [HomeController::class, 'storeRegister'])->name('storeRegister');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.index');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
require __DIR__.'/admin.php';
require __DIR__.'/membre.php';


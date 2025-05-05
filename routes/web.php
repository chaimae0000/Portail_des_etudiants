<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdherantController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    // Afficher la liste des adhérents
    Route::get('/gestion_adherants/visualiser-adherants', [AdherantController::class, 'index'])->name('visualiser_adherants');
});

// Regular profile route for authenticated users
// Admin route with the IsAdmin middleware, prefixed with 'admin'
// Routes for displaying, editing, updating, and deleting the profile



Route::get('/home', [HomeController::class, 'index']);



// Still let Breeze handle POST login/register
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-submit', [HomeController::class, 'submitLogin'])->name('login.submit');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/storeRegister', [HomeController::class, 'storeRegister'])->name('storeRegister');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.index');
Route::get('/member/dashboard', [HomeController::class, 'memberDashboard'])->name('member.dashboard');

require __DIR__.'/admin.php';


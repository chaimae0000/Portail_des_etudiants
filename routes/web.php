<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

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

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    

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

require __DIR__.'/auth.php';


Route::get('/home', [HomeController::class, 'index']);



// Still let Breeze handle POST login/register
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-submit', [HomeController::class, 'submitLogin'])->name('login.submit');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/storeRegister', [HomeController::class, 'storeRegister'])->name('storeRegister');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.index');
Route::get('/member/dashboard', [HomeController::class, 'memberDashboard'])->name('member.dashboard');

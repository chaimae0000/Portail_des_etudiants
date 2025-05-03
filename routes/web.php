<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);


// Still let Breeze handle POST login/register
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-submit', [HomeController::class, 'submitLogin'])->name('login.submit');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/storeRegister', [HomeController::class, 'storeRegister'])->name('storeRegister');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/member/dashboard', [HomeController::class, 'memberDashboard'])->name('member.dashboard');


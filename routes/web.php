<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Login admin
Route::middleware(['guest:guru'])->group(function(){
    Route::get('/', function () {
        return view('auth.user');
    })->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


// Login admin
    Route::get('/admin', function () {
        return view('auth.admin');
    })->name('loginadmin');
    Route::post('/admin/login', [AuthController::class, 'loginadmin']);
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware('auth:user')->name('admin.dashboard');



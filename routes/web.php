<?php

use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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


// Login user
Route::middleware(['guest:user'])->group(function(){
    Route::get('/', function () {
        return view('auth.user');
    })->name('authuser');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Login admin
Route::middleware(['guest:admin'])->group(function(){
    Route::get('/admin', function () {
        return view('auth.admin');
    })->name('loginadmin');
    Route::post('/admin/login', [AuthController::class, 'loginadmin']);
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboarduser', [DashboardController::class, 'index'])->name('dashboarduser');
});

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/logoutadmin', [AuthController::class, 'logoutadmin']);
    Route::get('/dashboardadmin', [DashboardController::class, 'index'])->name('dashboardadmin');

    // Route kelas
    Route::controller(App\Http\Controllers\KelasController::class)->group(function () {
        Route::get('/kelas', 'index')->name('kelasadmin.index');
        Route::post('/kelas',  'store')->name('kelasadmin.store');
        Route::put('/kelas/{id}',  'update')->name('kelasadmin.update');
        Route::delete('/kelas/{id}',  'destroy')->name('kelasadmin.destroy');
    });

    // Route semester
    Route::controller(App\Http\Controllers\SemesterController::class)->group(function(){
        Route::get('/semester', 'index')->name('semester.index');
        Route::post('/semester', 'store')->name('semester.store');
        Route::put('/semester/{id}', 'update')->name('semester.update');
        Route::delete('/semester/delete/{id}', 'destroy')->name('semester.destroy');
        Route::get('/semester/set-status/{id}/{status}', 'setStatus')->name('semester.setStatus');
    });
});

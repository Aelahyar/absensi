<?php

use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TahunAjaranController;
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

// Route user
Route::middleware(['auth:user'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboarduser', [DashboardUserController::class, 'index'])->name('dashboarduser');
    Route::post('/update_user', [DashboardUserController::class, 'updateprofile'])->name('update.user');

    // Route Siswa
    Route::controller(App\Http\Controllers\AbsensiController::class)->group(function(){
        Route::get('/absensi/{kelas}', 'index')->name('absensi.index');
        Route::post('/absensi', 'store')->name('absensi.store');
    });

    // Route Rekap absensi
    Route::controller(App\Http\Controllers\RekapController::class)->group(function(){
        Route::get('/rekapsiswa', 'index')->name('rekapsiswa');
    });
});

// Route admin
Route::middleware(['auth:admin'])->group(function(){
    Route::get('/logoutadmin', [AuthController::class, 'logoutadmin']);
    Route::get('/dashboardadmin', [DashboardController::class, 'index'])->name('dashboardadmin');
    Route::post('/update_admin', [DashboardController::class, 'updateprofile'])->name('update.password');

    // Route kelas
    Route::controller(App\Http\Controllers\KelasController::class)->group(function () {
        Route::get('/kelas', 'index')->name('kelasadmin.index');
        Route::post('/kelas',  'store')->name('kelasadmin.store');
        Route::put('/kelas/{id_mklas}',  'update')->name('kelasadmin.update');
        Route::delete('/kelas/{id_mklas}',  'destroy')->name('kelasadmin.destroy');
    });

    // Route semester
    Route::controller(App\Http\Controllers\SemesterController::class)->group(function(){
        Route::get('/semester', 'index')->name('semester.index');
        Route::post('/semester', 'store')->name('semester.store');
        Route::put('/semester/{id_semester}', 'update')->name('semester.update');
        Route::delete('/semester/delete/{id_semester}', 'destroy')->name('semester.destroy');
        Route::get('/semester/set-status/{id_semester}/{status}', 'setStatus')->name('semester.setStatus');
    });

    // Route Tahun Ajaran
    Route::controller(App\Http\Controllers\TahunAjaranController::class)->group(function () {
        Route::get('/tahun-ajaran', 'index')->name('tahunajaran.index');
        Route::post('/tahun-ajaran', 'store')->name('tahunajaran.store');
        Route::put('/tahun-ajaran/{id_thajaran}', 'update')->name('tahunajaran.update');
        Route::get('/tahun-ajaran/set-status/{id_thajaran}/{status}', 'setStatus')->name('tahunajaran.setStatus');
        Route::delete('/tahun-ajaran/{id_thajaran}', 'destroy')->name('tahunajaran.destroy');
    });

    // Route Mapel
    Route::controller(App\Http\Controllers\MapelController::class)->group(function(){
        Route::get('/mapel',  'index')->name('mapel.index');
        Route::post('/mapel',  'store')->name('mapel.store');
        Route::put('/mapel/{id_mapel}',  'update')->name('mapel.update');
        Route::delete('/mapel/{id_mapel}',  'destroy')->name('mapel.destroy');
    });

    // Route Wali Kelas
    Route::controller(App\Http\Controllers\WaliKelasController::class)->group(function(){
        Route::get('/walikelas',  'index')->name('walikelas.index');
        Route::post('/walikelas',  'store')->name('walikelas.store');
        Route::put('/walikelas/{id_walikelas}',  'update')->name('walikelas.update');
        Route::delete('/walikelas/{id_walikelas}',  'destroy')->name('walikelas.destroy');
    });

    // Route Guru
    Route::controller(App\Http\Controllers\GuruController::class)->group(function(){
        Route::get('/guru', 'index')->name('guru.index');
        Route::post('/guru', 'store')->name('guru.store');
        Route::put('/guru/{id_guru}', 'update')->name('guru.update');
        Route::delete('/guru/{id_guru}', 'destroy')->name('guru.destroy');
    });

    // Route Kepsek
    Route::controller(App\Http\Controllers\KepsekController::class)->group(function(){
        Route::get('/kepsek', 'index')->name('kepsek.index');
        Route::post('/kepsek', 'store')->name('kepsek.store');
        Route::put('/kepsek/{id_kepsek}', 'update')->name('kepsek.update');
        Route::delete('/kepsek/{id_kepsek}', 'destroy')->name('kepsek.destroy');
    });

    // Route Siswa
    Route::controller(App\Http\Controllers\SiswaController::class)->group(function(){
        Route::get('/siswa', 'index')->name('siswa.index');
        Route::post('/siswa', 'store')->name('siswa.store');
        Route::put('/siswa/{id_siswa}', 'update')->name('siswa.update');
        Route::delete('/siswa/{id_siswa}', 'destroy')->name('siswa.destroy');
    });
});

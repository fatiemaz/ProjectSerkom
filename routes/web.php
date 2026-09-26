<?php
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    // Route::get('/', function () {return view('admin.dashboard');});

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('user', UserController::class)->except(['show', 'create', 'edit']);

    Route::get('/profil-sekolah', [ProfileController::class, 'index'])->name('profil-sekolah.index');
    Route::put('/profil-sekolah', [ProfileController::class, 'update'])->name('profil-sekolah.update');

    Route::resource('guru', GuruController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('siswa', SiswaController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('ekstrakurikuler', EkstrakurikulerController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('prestasi', PrestasiController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('pengumuman', PengumumanController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('berita', BeritaController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('galeri', GaleriController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('/profile', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileUserController::class, 'updatePassword'])->name('profile.password');

});

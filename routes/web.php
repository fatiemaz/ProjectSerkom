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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::get('/', [PublicController::class, 'index'])->name('landing');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita.public');
Route::get('/ekstrakurikuler', [PublicController::class, 'ekskul'])->name('ekskul.public');

Route::middleware('auth')->group(function () {

    // Route::get('/', function () {return view('admin.dashboard');});

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('role:Admin')->group(function () {
        Route::resource('user', UserController::class)->except(['show', 'create', 'edit']);
    });

    Route::get('/profil-sekolah', [ProfileController::class, 'index'])->name('profil-sekolah.index');
    Route::put('/profil-sekolah', [ProfileController::class, 'update'])->name('profil-sekolah.update');

    // GURU & SISWA: semua role bisa lihat
    Route::resource('guru', GuruController::class)->only(['index']);
    Route::resource('siswa', SiswaController::class)->only(['index']);

     // GURU & SISWA: tambah, edit, hapus hanya Admin
    Route::middleware('role:Admin')->group(function () {
        Route::resource('guru', GuruController::class)->only(['store', 'update', 'destroy']);
        Route::resource('siswa', SiswaController::class)->only(['store', 'update', 'destroy']);
    });

    Route::resource('ekstrakurikuler', EkstrakurikulerController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('prestasi', PrestasiController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('pengumuman', PengumumanController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('berita', BeritaController::class)->only(['index', 'store', 'update', 'destroy'])
    ->parameters(['berita' => 'berita']);

    Route::resource('galeri', GaleriController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('/profile', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileUserController::class, 'updatePassword'])->name('profile.password');

});

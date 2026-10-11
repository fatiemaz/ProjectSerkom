<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\FasilitasController;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

    Route::get('/', [PublicController::class, 'index'])->name('landing');
    Route::get('/info/berita', [PublicController::class, 'berita'])->name('public.berita');
    Route::get('/info/berita/{berita:slug}', [PublicController::class, 'beritaShow'])->name('public.berita.show');

    Route::get('/info/prestasi', [PublicController::class, 'prestasi'])->name('public.prestasi');
    Route::get('/info/prestasi/{prestasi}', [PublicController::class, 'prestasiShow'])->name('public.prestasi.show');
    Route::get('/info/ekstrakurikuler', [PublicController::class, 'ekskul'])->name('public.ekskul');
    Route::get('/info/ekstrakurikuler/{ekstrakurikuler}', [PublicController::class, 'ekskulShow'])->name('public.ekskul.show');
    Route::get('/info/guru/{guru}', [PublicController::class, 'guruShow'])->name('public.guru.show');
    Route::get('/info/galeri/{galeri}', [PublicController::class, 'galeriShow'])->name('public.galeri.show');

    Route::get('/info/guru', [PublicController::class, 'guru'])->name('public.guru');
    Route::get('/info/galeri', [PublicController::class, 'galeri'])->name('public.galeri');
    Route::get('/info/profil', [PublicController::class, 'profil'])->name('public.profil');
    Route::get('/info/pengumuman', [PublicController::class, 'pengumuman'])->name('public.pengumuman');
    Route::get('/info/pengumuman/{id}', [PublicController::class, 'pengumumanShow'])->name('public.pengumuman.show');

Route::middleware('auth')->group(function () {

    // Route::get('/', function () {return view('admin.dashboard');});

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('role:Admin')->group(function () {
        Route::resource('user', UserController::class)->except(['show', 'create', 'edit']);
        Route::patch('user/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('user.toggle-status');
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
    Route::resource('fasilitas', FasilitasController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('pengumuman', PengumumanController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('berita', BeritaController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('galeri', GaleriController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('/profile', [ProfileUserController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileUserController::class, 'updatePassword'])->name('profile.password');

});

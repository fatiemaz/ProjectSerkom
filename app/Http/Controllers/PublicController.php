<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\Ekstrakurikuler;
use App\Models\Berita;

class PublicController extends Controller
{
    public function index()
    {
        $stats = [
            'siswa'  => Siswa::count(),
            'guru'   => Guru::count(),
            'prestasi' => Prestasi::count(),
            'ekskul' => Ekstrakurikuler::count(),
        ];

        $beritas = Berita::latest()->take(3)->get();
        $ekskuls = Ekstrakurikuler::take(6)->get();

        return view('public.landing_page', compact('stats', 'beritas', 'ekskuls'));
    }
}

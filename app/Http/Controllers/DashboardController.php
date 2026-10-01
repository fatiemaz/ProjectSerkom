<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa    = Siswa::count();
        $totalGuru     = Guru::count();
        $totalBerita   = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalPrestasi = Prestasi::count();
        $totalEkskul   = Ekstrakurikuler::count();
        $totalUser     = User::count();

        $pengumumanTerbaru = Pengumuman::where('status', 'Publish')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        $beritaTerbaru = Berita::where('status', 'Publish')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $siswaPerTahun = Siswa::select('tahun_masuk', DB::raw('COUNT(*) as total'))
            ->whereNotNull('tahun_masuk')
            ->groupBy('tahun_masuk')
            ->orderBy('tahun_masuk')
            ->get();

        $chartLabels = $siswaPerTahun->pluck('tahun_masuk');
        $chartData   = $siswaPerTahun->pluck('total');

        return view('admin.dashboard', compact(
            'totalSiswa', 'totalGuru', 'totalBerita', 'totalPengumuman',
            'totalPrestasi', 'totalEkskul', 'totalUser',
            'pengumumanTerbaru', 'beritaTerbaru',
            'chartLabels','chartData'
        ));
    }
}

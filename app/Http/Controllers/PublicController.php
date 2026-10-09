<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Ekstrakurikuler;
use App\Models\Berita;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    public function __construct()
    {
        // Share data profil ke semua view publik agar Navbar & Footer selalu dapat data profil
        $profilGlobal = Profile::first();
        View::share('profilGlobal', $profilGlobal);
    }

    public function index()
    {
        $stats = [
            'siswa'    => Siswa::count(),
            'guru'     => Guru::count(),
            'prestasi' => Prestasi::count(),
            'ekskul'   => Ekstrakurikuler::count(),
        ];

        $beritas     = Berita::where('status', 'Publish')->latest()->take(4)->get();
        $prestasis   = Prestasi::latest()->take(6)->get();
        $ekskuls     = Ekstrakurikuler::take(6)->get();
        $gurus       = Guru::latest()->take(4)->get();
        $galeris     = Galeri::latest()->take(8)->get();
        $pengumumans = Pengumuman::latest()->take(2)->get(); // Hanya ambil 2 pengumuman terbaru
        $profil      = Profile::first();

        return view('public.landing_page', compact('stats', 'beritas', 'ekskuls', 'prestasis', 'gurus', 'galeris', 'pengumumans', 'profil'));
    }

    public function berita()
    {
        $beritas = Berita::where('status', 'Publish')->latest()->paginate(9);
        return view('public.berita.index', compact('beritas'));
    }

    public function beritaShow(Berita $berita)
    {
        // Pastikan berita berstatus Publish
        abort_unless($berita->status === 'Publish', 404);

        $beritaLainnya = Berita::where('status', 'Publish')
            ->where('id_berita', '!=', $berita->id_berita)
            ->latest()
            ->take(3)
            ->get();

        return view('public.berita.show', compact('berita', 'beritaLainnya'));
    }

    public function prestasi()
    {
        $prestasis = Prestasi::latest()->paginate(12);
        return view('public.prestasi.index', compact('prestasis'));
    }

    public function prestasiShow(Prestasi $prestasi)
    {
        $lainnya = Prestasi::where('id_prestasi', '!=', $prestasi->id_prestasi)
            ->latest()
            ->take(4)
            ->get();

        return view('public.prestasi.show', compact('prestasi', 'lainnya'));
    }

    public function ekskul()
    {
        $ekskuls = Ekstrakurikuler::latest()->paginate(9);
        return view('public.ekstrakurikuler.index', compact('ekskuls'));
    }

    public function guru()
    {
        $gurus = Guru::latest()->paginate(12);
        return view('public.guru.index', compact('gurus'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('public.galeri.index', compact('galeris'));
    }

    public function profil()
    {
        $profil = Profile::first();
        return view('public.profile.index', compact('profil'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->paginate(9);
        return view('public.pengumuman.index', compact('pengumuman'));
    }

    public function pengumumanShow($id)
    {
        // Menggunakan getKeyName() agar otomatis menyesuaikan nama primary key (UUID/id_pengumuman)
        $pengumuman = Pengumuman::where((new Pengumuman)->getKeyName(), $id)->firstOrFail();

        $pengumumanLain = Pengumuman::where((new Pengumuman)->getKeyName(), '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('public.pengumuman.show', compact('pengumuman', 'pengumumanLain'));
    }

    public function ekskulShow($id)
    {
        $ekskul = Ekstrakurikuler::where((new Ekstrakurikuler)->getKeyName(), $id)->firstOrFail();
        $ekskulLain = Ekstrakurikuler::where((new Ekstrakurikuler)->getKeyName(), '!=', $id)->take(4)->get();
        return view('public.ekskul.show', compact('ekskul', 'ekskulLain'));
    }

    public function guruShow($id)
    {
        $guru = Guru::where((new Guru)->getKeyName(), $id)->firstOrFail();
        $guruLain = Guru::where((new Guru)->getKeyName(), '!=', $id)->take(4)->get();
        return view('public.guru.show', compact('guru', 'guruLain'));
    }

    public function galeriShow($id)
    {
        $galeri = Galeri::where((new Galeri)->getKeyName(), $id)->firstOrFail();
        $galeriLain = Galeri::where((new Galeri)->getKeyName(), '!=', $id)->latest()->take(6)->get();
        return view('public.galeri.show', compact('galeri', 'galeriLain'));
    }
}

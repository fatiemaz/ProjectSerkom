@extends('public.template')

@section('title', 'Data Siswa - SMPN 1 Mangunreja')

@section('content')

{{-- ===================== HERO HALAMAN ===================== --}}
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Siswa</div>
        <h1>Data Siswa</h1>
        <p>Total {{ $totalSiswa }} siswa terdaftar</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        {{-- ===================== DAFTAR SISWA ===================== --}}
        <div class="row g-4">
            @forelse ($siswas as $siswa)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="sph-card p-4 text-center">

                        {{-- Siswa tidak punya foto, jadi pakai ikon placeholder (sama seperti guru tanpa foto) --}}
                        <div class="mx-auto mb-3 overflow-hidden rounded-circle" style="width: 90px; height: 90px;">
                            <div class="thumb-ph w-100 h-100"><i class="bi bi-person-fill fs-1"></i></div>
                        </div>

                        <h6 class="fw-bold mb-2">{{ $siswa->nama_siswa }}</h6>

                        {{-- Kelas siswa (dari relasi kelas) --}}
                        @if ($siswa->kelas)
                            <span class="chip mb-2">{{ $siswa->kelas->nama_kelas }}</span>
                        @endif

                        {{-- NISN disamarkan lewat accessor nisn_samar di model Siswa --}}
                        <p class="text-muted small mb-0">NISN: {{ $siswa->nisn_samar }}</p>
                        <p class="text-muted small mb-0">{{ $siswa->jenis_kelamin ?? '-' }}</p>
                        @if ($siswa->tahun_masuk)
                            <p class="text-muted small mb-0">Angkatan {{ $siswa->tahun_masuk }}</p>
                        @endif

                        {{-- Seluruh kartu bisa diklik menuju halaman detail --}}
                        <a href="{{ route('public.siswa.show', $siswa->getKey()) }}" class="stretched-link"></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Data siswa tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination (filter tetap terbawa karena withQueryString di controller) --}}
        <div class="mt-5 d-flex justify-content-center">{{ $siswas->links() }}</div>
    </div>
</section>
@endsection

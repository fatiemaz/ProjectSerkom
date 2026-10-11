@extends('public.template')

@section('title', 'Prestasi - SMPN 1 Mangunreja')

@section('content')

<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Prestasi</div>
        <h1>Prestasi Siswa</h1>
        <p>Daftar capaian membanggakan peserta didik kami</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse ($prestasis as $prestasi)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="sph-card text-center">
                        <div class="zoom" style="height: 180px;">
                            @if ($prestasi->foto)
                                <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}">
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center text-warning" style="background: var(--navy);"><i class="bi bi-trophy-fill" style="font-size:3rem;"></i></div>
                            @endif
                        </div>
                        <div class="p-3">
                            <h6 class="fw-bold mb-1">{{ Str::limit($prestasi->nama_prestasi, 40) }}</h6>
                            <p class="text-muted small mb-2">{{ $prestasi->nama_siswa }}</p>
                            <span class="chip">{{ $prestasi->tingkat ?? '-' }}</span>
                            <span class="chip chip-gold">{{ $prestasi->tahun_ajaran }}</span>
                            <a href="{{ route('public.prestasi.show', $prestasi) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-trophy fs-1 d-block mb-2 opacity-50"></i>
                    Belum ada prestasi terdaftar.
                </div>
            @endforelse
        </div>

        @if ($prestasis->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $prestasis->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>

@endsection

@extends('public.template')

@section('title', 'Profil Sekolah - SMPN 1 Mangunreja')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Profil</div>
        <h1>Profil {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h1>
        <p>Mengenal lebih dekat visi, misi, dan identitas sekolah kami</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                @if ($profil?->foto && file_exists(public_path('storage/' . $profil->foto)))
                    <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Sekolah" class="frame-img" style="max-height: 400px;">
                @else
                    <div class="thumb-ph frame-img" style="height: 340px;"><i class="bi bi-building" style="font-size:4rem;"></i></div>
                @endif
            </div>
            <div class="col-lg-6">
                <span class="eyebrow">Tentang Kami</span>
                <h2 class="sec-title mb-3">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h2>
                <p class="text-secondary lh-lg">{{ $profil->deskripsi ?? 'Sekolah menengah pertama pilihan utama yang membentuk generasi unggul, berkarakter, dan berprestasi.' }}</p>
            </div>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="meta">Kepala Sekolah</div><div class="fw-bold fs-5">{{ $profil->kepala_sekolah ?? '-' }}</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="meta">NPSN</div><div class="fw-bold fs-5">{{ $profil->npsn ?? '-' }}</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="meta">Tahun Berdiri</div><div class="fw-bold fs-5">{{ $profil->tahun_berdiri ?? '-' }}</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="meta">Kontak / Telp</div><div class="fw-bold fs-5">{{ $profil->kontak ?? '-' }}</div></div></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-5 rounded-4 h-100 text-white" style="background: var(--navy);">
                    <i class="bi bi-eye-fill fs-2 text-warning"></i>
                    <h3 class="fw-bold mt-2 mb-3">Visi Sekolah</h3>
                    <p class="fs-5 mb-0 opacity-90">{{ $profil->visi ?? 'Belum diisi.' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="sph-card p-5">
                    <i class="bi bi-bullseye fs-2" style="color: var(--gold);"></i>
                    <h3 class="fw-bold text-primary mt-2 mb-3">Misi Sekolah</h3>
                    <div class="prose">{!! nl2br(e($profil->misi ?? 'Belum diisi.')) !!}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

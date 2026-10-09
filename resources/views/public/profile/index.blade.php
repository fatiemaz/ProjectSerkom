@extends('public.template')

@section('title', 'Profil Sekolah - SMPN 1 Mangunreja')

@section('content')
<div class="bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Profil {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h1>
        <p class="lead mb-0">Mengenal lebih dekat visi, misi, dan identitas sekolah kami</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            @if ($profil?->foto && file_exists(public_path('storage/' . $profil->foto)))
                <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Sekolah" class="img-fluid rounded-4 shadow w-100" style="max-height: 380px; object-fit: cover;">
            @else
                <div class="bg-light rounded-4 shadow d-flex align-items-center justify-content-center" style="height: 340px;">
                    <i class="bi bi-building text-primary fs-1"></i>
                </div>
            @endif
        </div>
        <div class="col-lg-6">
            <h2 class="fw-bold text-primary mb-3">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h2>
            <p class="text-secondary fs-5">{{ $profil->deskripsi ?? 'Sekolah menengah pertama pilihan utama yang membentuk generasi unggul, berkarakter, dan berprestasi.' }}</p>
            <hr class="my-4">
            <div class="row g-3">
                <div class="col-sm-6">
                    <strong>Kepala Sekolah:</strong>
                    <p class="text-muted mb-0">{{ $profil->kepala_sekolah ?? '-' }}</p>
                </div>
                <div class="col-sm-6">
                    <strong>NPSN:</strong>
                    <p class="text-muted mb-0">{{ $profil->npsn ?? '-' }}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Tahun Berdiri:</strong>
                    <p class="text-muted mb-0">{{ $profil->tahun_berdiri ?? '-' }}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Kontak / Telp:</strong>
                    <p class="text-muted mb-0">{{ $profil->kontak ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- VISI & MISI --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-light">
                <h4 class="fw-bold text-primary mb-3"><i class="bi bi-eye-fill me-2"></i>Visi Sekolah</h4>
                <p class="text-secondary fs-5 mb-0">{{ $profil->visi ?? 'Belum diisi.' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-light">
                <h4 class="fw-bold text-primary mb-3"><i class="bi bi-bullseye me-2"></i>Misi Sekolah</h4>
                <div class="text-secondary fs-6">{!! nl2br(e($profil->misi ?? 'Belum diisi.')) !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection

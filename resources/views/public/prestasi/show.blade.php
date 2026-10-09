@extends('public.template')

@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('landing') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('public.prestasi') }}">Prestasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($prestasi->nama_prestasi, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-5 align-items-start">
        <div class="col-lg-6">
            @if ($prestasi->foto)
                <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 400px; object-fit: cover;">
            @else
                <div class="bg-all text-white rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="height: 350px;">
                    <i class="bi bi-trophy fs-1"></i>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <span class="badge bg-primary px-3 py-2 me-1">{{ $prestasi->tingkat ?? '-' }}</span>
            <span class="badge bg-secondary px-3 py-2">{{ $prestasi->tahun_ajaran }}</span>

            <h2 class="fw-bold text-primary mt-3">{{ $prestasi->nama_prestasi }}</h2>
            <div class="bg-success rounded-pill mb-4" style="width: 60px; height: 4px;"></div>

            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="bi bi-person-fill text-primary me-2"></i> <strong>Peraih:</strong> {{ $prestasi->nama_siswa }}</li>
                <li class="mb-2"><i class="bi bi-award-fill text-primary me-2"></i> <strong>Tingkat:</strong> {{ $prestasi->tingkat ?? '-' }}</li>
                <li class="mb-2"><i class="bi bi-calendar-event me-2 text-primary"></i> <strong>Tahun Ajaran:</strong> {{ $prestasi->tahun_ajaran }}</li>
            </ul>

            @if (!empty($prestasi->deskripsi))
                <div class="text-secondary bg-light p-3 rounded-3 border-start border-4 border-primary">
                    {!! nl2br(e($prestasi->deskripsi)) !!}
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('public.prestasi') }}" class="btn btn-outline-primary px-4 rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Prestasi
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

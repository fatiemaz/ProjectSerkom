@extends('public.template')

@section('content')

<section class="sec">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.prestasi') }}" class="text-decoration-none">Prestasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($prestasi->nama_prestasi, 30) }}</li>
            </ol>
        </nav>

        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                @if ($prestasi->foto)
                    <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}" class="frame-img" style="max-height: 420px;">
                @else
                    <div class="frame-img d-flex align-items-center justify-content-center text-warning" style="height: 350px; background: var(--navy);"><i class="bi bi-trophy" style="font-size:4rem;"></i></div>
                @endif
            </div>

            <div class="col-lg-6">
                <span class="chip">{{ $prestasi->tingkat ?? '-' }}</span>
                <span class="chip chip-gold">{{ $prestasi->tahun_ajaran }}</span>

                <h2 class="sec-title mt-3 mb-4">{{ $prestasi->nama_prestasi }}</h2>

                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><i class="bi bi-person-fill text-primary me-2"></i> <strong>Peraih:</strong> {{ $prestasi->nama_siswa }}</li>
                    <li class="mb-2"><i class="bi bi-award-fill text-primary me-2"></i> <strong>Tingkat:</strong> {{ $prestasi->tingkat ?? '-' }}</li>
                    <li class="mb-2"><i class="bi bi-calendar-event text-primary me-2"></i> <strong>Tahun Ajaran:</strong> {{ $prestasi->tahun_ajaran }}</li>
                </ul>

                @if (!empty($prestasi->deskripsi))
                    <div class="prose p-4 rounded-4" style="background: var(--soft); border-left: 4px solid var(--gold);">
                        {!! nl2br(e($prestasi->deskripsi)) !!}
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('public.prestasi') }}" class="btn-sph"><i class="bi bi-arrow-left me-2"></i> Kembali ke Prestasi</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

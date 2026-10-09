@extends('public.template')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('public.berita') }}" class="btn btn-sm btn-outline-secondary mb-3 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Berita
            </a>

            <h1 class="fw-bold text-primary mb-2">{{ $berita->judul }}</h1>
            <p class="text-muted small mb-4">
                <i class="bi bi-calendar3 me-1"></i> {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
            </p>

            @if ($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" alt="{{ $berita->judul }}" style="max-height: 450px; object-fit: cover;">
            @endif

            <div class="lh-lg text-secondary border-top pt-3 fs-6">
                {!! nl2br(e($berita->isi)) !!}
            </div>
        </div>
    </div>
</div>

@endsection

@extends('public.template')

@section('content')

<section class="bg-all text-white text-center py-5 mb-4">
    <div class="container py-3">
        <h1 class="fw-bold mb-2">Berita & Informasi</h1>
        <p class="mb-0 opacity-75">Kabar terbaru dan pengumuman dari sekolah kami</p>
    </div>
</section>

<div class="container py-4">
    <div class="row g-4">
        @forelse ($beritas as $berita)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover rounded-3 overflow-hidden">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <small class="text-muted mb-2">
                            <i class="bi bi-calendar3 me-1"></i> {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                        </small>
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-dark text-decoration-none stretched-link">
                                {{ Str::limit($berita->judul, 60) }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small mt-auto">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                Belum ada berita dipublikasikan.
            </div>
        @endforelse
    </div>

    @if ($beritas->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $beritas->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection

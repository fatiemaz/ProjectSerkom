@extends('public.template')

@section('content')

<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Berita</div>
        <h1>Berita &amp; Informasi</h1>
        <p>Kabar terbaru dan pengumuman dari sekolah kami</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse ($beritas as $berita)
                <div class="col-md-6 col-lg-4">
                    <div class="sph-card d-flex flex-column">
                        <div class="zoom" style="height: 210px;">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                            @else
                                <div class="thumb-ph h-100"><i class="bi bi-newspaper" style="font-size:2.5rem;"></i></div>
                            @endif
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <span class="meta mb-2"><i class="bi bi-calendar3 me-1"></i> {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}</span>
                            <h5 class="mb-2"><a href="{{ route('public.berita.show', $berita->slug) }}" class="ctitle stretched-link">{{ Str::limit($berita->judul, 60) }}</a></h5>
                            <p class="text-muted small mb-0 mt-auto">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada berita dipublikasikan.</div>
            @endforelse
        </div>

        @if ($beritas->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $beritas->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>

@endsection

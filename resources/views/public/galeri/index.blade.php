@extends('public.template')

@section('title', 'Galeri Sekolah - SMPN 1 Mangunreja')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Galeri</div>
        <h1>Galeri Dokumentasi</h1>
        <p>Momen dan dokumentasi kegiatan SMPN 1 Mangunreja</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse ($galeris as $galeri)
                <div class="col-md-6 col-lg-4">
                    <div class="sph-card">
                        @if ($galeri->kategori === 'Video')
                            <div class="ratio ratio-16x9">
                                <video controls>
                                    <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            </div>
                        @else
                            <div class="zoom" style="height: 230px;">
                                @if ($galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}">
                                @else
                                    <div class="thumb-ph h-100"><i class="bi bi-image" style="font-size:2.5rem;"></i></div>
                                @endif
                            </div>
                        @endif
                        <div class="p-4">
                            <span class="chip mb-2">{{ $galeri->kategori ?? 'Foto' }}</span>
                            <h6 class="fw-bold mb-1">
                                @if ($galeri->kategori !== 'Video')
                                    <a href="{{ route('public.galeri.show', $galeri) }}" class="ctitle stretched-link">{{ $galeri->judul }}</a>
                                @else
                                    {{ $galeri->judul }}
                                @endif
                            </h6>
                            <span class="meta d-block mb-2"><i class="bi bi-calendar3 me-1"></i>{{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d M Y') : '-' }}</span>
                            <p class="text-secondary small mb-0">{{ $galeri->keterangan }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><p class="text-muted fs-5">Belum ada dokumentasi di galeri.</p></div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">{{ $galeris->links() }}</div>
    </div>
</section>
@endsection

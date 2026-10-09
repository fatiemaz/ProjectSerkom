@extends('public.template')

@section('content')
@php $fotoGaleri = $galeri->file ?? $galeri->foto; @endphp
<section class="sec">
    <div class="container">
        <div class="crumbs text-muted small mb-4"><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Beranda</a> / <a href="{{ route('public.galeri') }}" class="text-muted text-decoration-none">Galeri</a></div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="sph-card">
                    @if(!empty($fotoGaleri))
                        <img src="{{ asset('storage/' . $fotoGaleri) }}" class="w-100" alt="{{ $galeri->judul }}" style="max-height: 480px; object-fit: cover;">
                    @endif
                    <div class="p-4 p-md-5">
                        <span class="meta"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d F Y') }}</span>
                        <h2 class="fw-bold text-primary my-2">{{ $galeri->judul }}</h2>

                        @if(!empty($galeri->keterangan) || !empty($galeri->deskripsi))
                            <div class="prose mt-3 mb-4">{!! nl2br(e($galeri->keterangan ?? $galeri->deskripsi)) !!}</div>
                        @endif

                        <div class="pt-3 border-top">
                            <a href="{{ route('public.galeri') }}" class="btn-sph-o btn-sm-pill"><i class="bi bi-arrow-left me-1"></i> Kembali ke Galeri</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sph-card p-4">
                    <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom">Galeri Foto Lainnya</h6>
                    <div class="row g-2">
                        @forelse($galeriLain as $item)
                            @php $fotoItem = $item->file ?? $item->foto; @endphp
                            <div class="col-6">
                                <a href="{{ route('public.galeri.show', $item) }}" class="d-block text-decoration-none text-dark">
                                    <div class="zoom rounded-3" style="height:100px;">
                                        @if(!empty($fotoItem))
                                            <img src="{{ asset('storage/' . $fotoItem) }}" alt="">
                                        @else
                                            <div class="thumb-ph h-100"><i class="bi bi-image fs-3"></i></div>
                                        @endif
                                    </div>
                                    <small class="d-block text-truncate fw-semibold mt-1">{{ $item->judul }}</small>
                                </a>
                            </div>
                        @empty
                            <div class="col-12"><small class="text-muted">Belum ada foto lainnya.</small></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

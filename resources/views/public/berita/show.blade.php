@extends('public.template')

@section('content')

<section class="sec">
    <div class="container">
        <a href="{{ route('public.berita') }}" class="link-arrow small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Berita</a>

        <div class="row g-5 mt-1">

            {{-- ARTIKEL --}}
            <div class="col-lg-8">
                <span class="eyebrow">Berita</span>
                <h1 class="fw-bold text-primary mb-3" style="font-size: clamp(1.8rem, 4vw, 2.6rem); line-height: 1.2;">{{ $berita->judul }}</h1>
                <p class="meta mb-4">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                </p>

                @if ($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-100 mb-4" alt="{{ $berita->judul }}"
                         style="max-height: 450px; object-fit: cover; border-radius: 20px;">
                @endif

                <div class="prose border-top pt-4">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </div>

            {{-- SIDEBAR: BERITA LAINNYA --}}
            @if ($lainnya->isNotEmpty())
                <div class="col-lg-4">
                    <div class="border rounded-4 p-4 bg-white sticky-top" style="top: 100px;">
                        <h5 class="fw-bold text-primary pb-3 mb-3 border-bottom">Berita Lainnya</h5>

                        <div class="d-flex flex-column gap-3">
                            @foreach ($lainnya as $item)
                                <a href="{{ route('public.berita.show', $item->slug) }}" class="text-decoration-none text-body">
                                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-light">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center text-primary">
                                                <i class="bi bi-newspaper fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-2 text-truncate">{{ $item->judul }}</div>
                                    <small class="text-muted">
                                        {{ ($item->tanggal ? \Carbon\Carbon::parse($item->tanggal) : $item->created_at)->translatedFormat('d F Y') }}
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>

@endsection

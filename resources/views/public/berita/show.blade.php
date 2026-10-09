@extends('public.template')

@section('content')

<section class="sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a href="{{ route('public.berita') }}" class="link-arrow small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Berita</a>

                <div class="mt-4">
                    <span class="eyebrow">Berita</span>
                    <h1 class="fw-bold text-primary mb-3" style="font-size: clamp(1.8rem, 4vw, 2.6rem); line-height: 1.2;">{{ $berita->judul }}</h1>
                    <p class="meta mb-4"><i class="bi bi-calendar3 me-1"></i> {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}</p>
                </div>

                @if ($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-100 mb-4" alt="{{ $berita->judul }}" style="max-height: 450px; object-fit: cover; border-radius: 20px;">
                @endif

                <div class="prose border-top pt-4">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

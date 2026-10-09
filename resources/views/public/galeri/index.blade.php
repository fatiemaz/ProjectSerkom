@extends('public.template')

@section('title', 'Galeri Sekolah - SMPN 1 Mangunreja')

@section('content')
<div class="bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Galeri Dokumentasi</h1>
        <p class="lead mb-0">Momen dan dokumentasi kegiatan SMPN 1 Mangunreja</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse ($galeris as $galeri)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    @if ($galeri->kategori === 'Video')
                        <div class="ratio ratio-16x9">
                            <video controls>
                                <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        </div>
                    @else
                        @if ($galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                            <img src="{{ asset('storage/' . $galeri->file) }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-image text-secondary fs-1"></i>
                            </div>
                        @endif
                    @endif
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ $galeri->kategori ?? 'Foto' }}</span>
                        <h6 class="fw-bold text-dark mb-1">{{ $galeri->judul }}</h6>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar3 me-1"></i>{{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') : '-' }}
                        </small>
                        <p class="card-text text-secondary small">{{ $galeri->keterangan }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada dokumentasi di galeri.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $galeris->links() }}
    </div>
</div>
@endsection

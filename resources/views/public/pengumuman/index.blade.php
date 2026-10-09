@extends('public.template')

@section('content')
<div class="bg-light py-4 mb-4 border-bottom">
    <div class="container">
        <h2 class="section-title text-center mb-1">Pengumuman Resmi</h2>
        <p class="text-muted text-center mb-0">Informasi dan pengumuman terbaru dari {{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</p>
        <div class="section-line"></div>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse($pengumuman as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center text-muted small mb-2">
                            <i class="bi bi-calendar3 me-1"></i>
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                        <h5 class="card-title fw-bold text-primary mb-3">
                            <a href="{{ route('public.pengumuman.show', $item) }}" class="text-decoration-none text-dark">
                                {{ $item->judul }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                        <div class="mt-3 pt-3 border-top">
                            <a href="{{ route('public.pengumuman.show', $item) }}" class="btn btn-outline-primary btn-sm fw-semibold w-100">
                                Baca Pengumuman <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-megaphone text-muted display-4 d-block mb-3"></i>
                <h5 class="text-muted">Belum ada pengumuman terbaru.</h5>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $pengumuman->links() }}
    </div>
</div>
@endsection

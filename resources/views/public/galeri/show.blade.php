@extends('public.template')

@section('content')
<div class="container py-4 my-3">
    <div class="row g-4">
        {{-- Detail Galeri Foto --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden">
                @if(!empty($galeri->foto))
                    <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-100" alt="{{ $galeri->judul }}" style="max-height: 480px; object-fit: cover;">
                @endif
                <div class="card-body p-4">
                    <div class="d-flex align-items-center text-muted small mb-2">
                        <i class="bi bi-calendar3 me-1"></i>
                        <span>{{ \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                    <h3 class="fw-bold text-primary mb-3">{{ $galeri->judul }}</h3>
                    <hr class="my-3">

                    @if(!empty($galeri->keterangan) || !empty($galeri->deskripsi))
                        <div class="lh-lg text-muted mb-4">
                            {!! nl2br(e($galeri->keterangan ?? $galeri->deskripsi)) !!}
                        </div>
                    @endif

                    <div class="pt-3 border-top">
                        <a href="{{ route('public.galeri') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Galeri Foto Lainnya --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Galeri Foto Lainnya</h6>
                <div class="row g-2">
                    @forelse($galeriLain as $item)
                        <div class="col-6">
                            <a href="{{ route('public.galeri.show', $item) }}" class="d-block text-decoration-none text-dark card-hover rounded overflow-hidden">
                                @if(!empty($item->foto))
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 rounded" style="height: 100px; object-fit: cover;">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                        <i class="bi bi-image text-muted fs-3"></i>
                                    </div>
                                @endif
                                <small class="d-block text-truncate fw-semibold mt-1 px-1">{{ $item->judul }}</small>
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
@endsection

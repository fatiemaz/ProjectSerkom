@extends('public.template')

@section('content')
<div class="container py-4 my-3">
    <div class="row g-4">
        {{-- Konten Utama --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden">
                @if(!empty($ekskul->foto))
                    <img src="{{ asset('storage/' . $ekskul->foto) }}" class="card-img-top style-detail-img" alt="{{ $ekskul->nama_ekskul }}" style="max-height: 400px; object-fit: cover;">
                @endif
                <div class="card-body p-4">
                    <h2 class="fw-bold text-primary mb-2">{{ $ekskul->nama_ekskul }}</h2>
                    <hr class="my-3">

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded border">
                                <small class="text-muted d-block fw-semibold">Pembina / Pelatih</small>
                                <span class="fw-bold text-dark"><i class="bi bi-person-badge me-1 text-primary"></i> {{ $ekskul->pembina ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded border">
                                <small class="text-muted d-block fw-semibold">Jadwal Latihan</small>
                                <span class="fw-bold text-dark"><i class="bi bi-calendar-week me-1 text-primary"></i> {{ $ekskul->jadwal ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark mb-2">Deskripsi Kegiatan</h5>
                    <div class="lh-lg text-muted">
                        {!! nl2br(e($ekskul->deskripsi ?? 'Belum ada deskripsi untuk ekstrakurikuler ini.')) !!}
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('public.ekskul') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Ekstrakurikuler
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Ekskul Lain --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Ekstrakurikuler Lainnya</h6>
                <div class="d-flex flex-column gap-3">
                    @forelse($ekskulLain as $item)
                        <div class="d-flex gap-3 align-items-center">
                            @if(!empty($item->foto))
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-dribbble fs-4"></i>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('public.ekskul.show', $item) }}" class="text-decoration-none fw-semibold text-dark d-block">
                                    {{ $item->nama_ekskul }}
                                </a>
                                <small class="text-muted"><i class="bi bi-person me-1"></i> {{ $item->pembina ?? '-' }}</small>
                            </div>
                        </div>
                    @empty
                        <small class="text-muted">Tidak ada ekstrakurikuler lain.</small>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

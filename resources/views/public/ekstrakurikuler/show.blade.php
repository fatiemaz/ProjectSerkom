@extends('public.template')

@section('content')
@php $fotoEkskul = $ekskul->gambar ?? $ekskul->foto; @endphp
<section class="sec">
    <div class="container">
        <div class="crumbs text-muted small mb-4"><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Beranda</a> / <a href="{{ route('public.ekskul') }}" class="text-muted text-decoration-none">Ekstrakurikuler</a></div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="sph-card">
                    @if(!empty($fotoEkskul))
                        <img src="{{ asset('storage/' . $fotoEkskul) }}" class="w-100" alt="{{ $ekskul->nama_ekskul }}" style="max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="p-4 p-md-5">
                        <span class="eyebrow">Ekstrakurikuler</span>
                        <h2 class="fw-bold text-primary mb-4">{{ $ekskul->nama_ekskul }}</h2>

                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="p-3 rounded-4" style="background: var(--soft);">
                                    <div class="meta fw-semibold">Pembina / Pelatih</div>
                                    <span class="fw-bold"><i class="bi bi-person-badge me-1 text-primary"></i> {{ $ekskul->pembina ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded-4" style="background: var(--soft);">
                                    <div class="meta fw-semibold">Jadwal Latihan</div>
                                    <span class="fw-bold"><i class="bi bi-calendar-week me-1 text-primary"></i> {{ $ekskul->jadwal_latihan ?? $ekskul->jadwal ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">Deskripsi Kegiatan</h5>
                        <div class="prose">{!! nl2br(e($ekskul->deskripsi ?? 'Belum ada deskripsi untuk ekstrakurikuler ini.')) !!}</div>

                        <div class="mt-4 pt-3 border-top">
                            <a href="{{ route('public.ekskul') }}" class="btn-sph-o btn-sm-pill"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Ekstrakurikuler</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sph-card p-4">
                    <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom">Ekstrakurikuler Lainnya</h6>
                    <div class="d-flex flex-column gap-3">
                        @forelse($ekskulLain as $item)
                            @php $fotoItem = $item->gambar ?? $item->foto; @endphp
                            <div class="d-flex gap-3 align-items-center">
                                @if(!empty($fotoItem))
                                    <img src="{{ asset('storage/' . $fotoItem) }}" class="rounded-3" width="60" height="60" style="object-fit: cover;" alt="">
                                @else
                                    <div class="thumb-ph rounded-3" style="width:60px;height:60px;"><i class="bi bi-dribbble fs-4"></i></div>
                                @endif
                                <div>
                                    <a href="{{ route('public.ekskul.show', $item) }}" class="ctitle d-block">{{ $item->nama_ekskul }}</a>
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
</section>
@endsection

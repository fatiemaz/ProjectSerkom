@extends('public.template')

@section('content')
<section class="sec">
    <div class="container">
        <div class="crumbs text-muted small mb-4"><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Beranda</a> / <a href="{{ route('public.guru') }}" class="text-muted text-decoration-none">Guru &amp; Staf</a></div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="sph-card p-4 p-md-5">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            @if(!empty($guru->foto))
                                <img src="{{ asset('storage/' . $guru->foto) }}" class="w-100" style="max-height: 280px; object-fit: cover; border-radius: 18px;" alt="">
                            @else
                                <div class="thumb-ph w-100" style="height: 250px; border-radius: 18px;"><i class="bi bi-person-circle display-1"></i></div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <span class="chip chip-gold mb-2">{{ $guru->jabatan ?? 'Guru / Staf Pengajar' }}</span>
                            <h2 class="fw-bold text-primary mb-1">{{ $guru->nama_guru ?? $guru->nama }}</h2>
                            <p class="text-muted mb-3"><i class="bi bi-card-text me-1"></i> NIP: {{ $guru->nip ?? '-' }}</p>
                            <div class="p-3 rounded-4" style="background: var(--soft);">
                                <div class="meta fw-semibold mb-1">Mata Pelajaran / Tugas</div>
                                <span class="fw-bold text-primary">{{ $guru->mapel ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    @if(!empty($guru->biografi) || !empty($guru->deskripsi))
                        <div class="mt-4 pt-4 border-top">
                            <h5 class="fw-bold mb-2">Profil Singkat</h5>
                            <p class="prose mb-0">{{ $guru->biografi ?? $guru->deskripsi }}</p>
                        </div>
                    @endif

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('public.guru') }}" class="btn-sph-o btn-sm-pill"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Guru &amp; Staf</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sph-card p-4">
                    <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom">Tenaga Pendidik Lainnya</h6>
                    <div class="d-flex flex-column gap-3">
                        @forelse($guruLain as $item)
                            <div class="d-flex gap-3 align-items-center">
                                @if(!empty($item->foto))
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="rounded-circle" width="50" height="50" style="object-fit: cover;" alt="">
                                @else
                                    <div class="thumb-ph rounded-circle" style="width:50px;height:50px;"><i class="bi bi-person fs-4"></i></div>
                                @endif
                                <div>
                                    <a href="{{ route('public.guru.show', $item) }}" class="ctitle d-block">{{ $item->nama_guru ?? $item->nama }}</a>
                                    <small class="text-muted">{{ $item->mapel ?? $item->jabatan ?? '-' }}</small>
                                </div>
                            </div>
                        @empty
                            <small class="text-muted">Tidak ada data lain.</small>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

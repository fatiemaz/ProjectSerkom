@extends('public.template')

@section('content')
<div class="container py-4 my-3">
    <div class="row g-4">
        {{-- Profile Card Utama --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <div class="row align-items-center g-4">
                    <div class="col-md-4 text-center">
                        @if(!empty($guru->foto))
                            <img src="{{ asset('storage/' . $guru->foto) }}" class="img-fluid rounded shadow-sm" style="max-height: 280px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="height: 250px; width: 100%;">
                                <i class="bi bi-person-circle text-secondary display-1"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <span class="badge bg-primary px-3 py-2 mb-2">{{ $guru->jabatan ?? 'Guru / Staf Pengajar' }}</span>
                        <h3 class="fw-bold text-dark mb-1">{{ $guru->nama }}</h3>
                        <p class="text-muted mb-3"><i class="bi bi-card-text me-1"></i> NIP: {{ $guru->nip ?? '-' }}</p>

                        <div class="p-3 bg-light rounded border mb-3">
                            <small class="text-muted d-block font-weight-bold mb-1">Mata Pelajaran / Tugas</small>
                            <span class="fw-bold text-primary fs-6">{{ $guru->mapel ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                @if(!empty($guru->biografi) || !empty($guru->deskripsi))
                    <div class="mt-4 pt-3 border-top">
                        <h5 class="fw-bold text-dark mb-2">Profil Singkat</h5>
                        <p class="text-muted lh-lg mb-0">
                            {{ $guru->biografi ?? $guru->deskripsi }}
                        </p>
                    </div>
                @endif

                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('public.guru') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Guru & Staf
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar Guru Lain --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Tenaga Pendidik Lainnya</h6>
                <div class="d-flex flex-column gap-3">
                    @forelse($guruLain as $item)
                        <div class="d-flex gap-3 align-items-center">
                            @if(!empty($item->foto))
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person fs-4"></i>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('public.guru.show', $item) }}" class="text-decoration-none fw-semibold text-dark d-block">
                                    {{ $item->nama }}
                                </a>
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
@endsection

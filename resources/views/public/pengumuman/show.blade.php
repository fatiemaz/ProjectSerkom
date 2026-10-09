@extends('public.template')

@section('content')
<div class="container py-4 my-3">
    <div class="row g-4">
        {{-- Detail Konten Pengumuman --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center text-muted small mb-2">
                    <i class="bi bi-calendar3 me-1"></i>
                    <span>Diterbitkan: {{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y H:i') }} WIB</span>
                </div>
                <h2 class="fw-bold text-primary mb-3">{{ $pengumuman->judul }}</h2>
                <hr class="my-3">

                @if(!empty($pengumuman->lampiran))
                    <div class="alert alert-info d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <i class="bi bi-file-earmark-arrow-down fs-4 me-2"></i>
                            <span>Unduh Lampiran Resmi Pengumuman</span>
                        </div>
                        <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="bi bi-download me-1"></i> Unduh File
                        </a>
                    </div>
                @endif

                <div class="lh-lg text-dark">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>

                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('public.pengumuman') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pengumuman
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar Pengumuman Lainnya --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Pengumuman Lainnya</h6>
                <div class="d-flex flex-column gap-3">
                    @forelse($pengumumanLain as $lain)
                        <div>
                            <small class="text-muted d-block">{{ \Carbon\Carbon::parse($lain->created_at)->format('d/m/Y') }}</small>
                            <a href="{{ route('public.pengumuman.show', $lain) }}" class="text-decoration-none fw-semibold text-dark">
                                {{ Str::limit($lain->judul, 60) }}
                            </a>
                        </div>
                    @empty
                        <small class="text-muted">Tidak ada pengumuman lain.</small>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

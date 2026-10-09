@extends('public.template')

@section('content')
<section class="sec">
    <div class="container">
        <div class="crumbs text-muted small mb-4"><a href="{{ route('landing') }}" class="text-muted text-decoration-none">Beranda</a> / <a href="{{ route('public.pengumuman') }}" class="text-muted text-decoration-none">Pengumuman</a></div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="sph-card p-4 p-md-5">
                    <span class="eyebrow">Pengumuman</span>
                    <h2 class="fw-bold text-primary mb-2">{{ $pengumuman->judul }}</h2>
                    <p class="meta mb-4 pb-3 border-bottom"><i class="bi bi-calendar3 me-1"></i> Diterbitkan: {{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y H:i') }} WIB</p>

                    @if(!empty($pengumuman->lampiran))
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 rounded-4 mb-4" style="background: rgba(242,169,0,.15);">
                            <div><i class="bi bi-file-earmark-arrow-down fs-4 me-2"></i><span class="fw-semibold">Unduh Lampiran Resmi Pengumuman</span></div>
                            <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank" class="btn-sph btn-sm-pill"><i class="bi bi-download me-1"></i> Unduh File</a>
                        </div>
                    @endif

                    <div class="prose">{!! nl2br(e($pengumuman->isi)) !!}</div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('public.pengumuman') }}" class="btn-sph-o btn-sm-pill"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pengumuman</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sph-card p-4">
                    <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom">Pengumuman Lainnya</h6>
                    <div class="d-flex flex-column gap-3">
                        @forelse($pengumumanLain as $lain)
                            <div>
                                <small class="meta d-block">{{ \Carbon\Carbon::parse($lain->created_at)->format('d/m/Y') }}</small>
                                <a href="{{ route('public.pengumuman.show', $lain) }}" class="ctitle">{{ Str::limit($lain->judul, 60) }}</a>
                            </div>
                        @empty
                            <small class="text-muted">Tidak ada pengumuman lain.</small>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

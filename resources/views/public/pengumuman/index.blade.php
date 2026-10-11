@extends('public.template')

@section('title', 'Pengumuman - SMPN 1 Mangunreja')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Pengumuman</div>
        <h1>Pengumuman Resmi</h1>
        <p>Informasi dan pengumuman terbaru dari {{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse($pengumuman as $item)
                @php $tgl = \Carbon\Carbon::parse($item->created_at); @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="sph-card p-4 d-flex flex-column">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="date-box"><b>{{ $tgl->format('d') }}</b><small>{{ $tgl->translatedFormat('M Y') }}</small></div>
                            <span class="meta"><i class="bi bi-calendar3 me-1"></i>{{ $tgl->translatedFormat('d F Y') }}</span>
                        </div>
                        <h5 class="mb-2"><a href="{{ route('public.pengumuman.show', $item) }}" class="ctitle">{{ $item->judul }}</a></h5>
                        <p class="text-muted small flex-grow-1">{{ Str::limit(strip_tags($item->isi), 120) }}</p>
                        <a href="{{ route('public.pengumuman.show', $item) }}" class="link-arrow mt-2">Baca Pengumuman <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-megaphone text-muted display-4 d-block mb-3"></i>
                    <h5 class="text-muted">Belum ada pengumuman terbaru.</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">{{ $pengumuman->links() }}</div>
    </div>
</section>
@endsection

@extends('public.template')

@section('title', 'Guru & Staf - SMPN 1 Mangunreja')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Guru &amp; Staf</div>
        <h1>Guru &amp; Tenaga Kependidikan</h1>
        <p>Tenaga pengajar profesional dan berdedikasi tinggi</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse ($gurus as $guru)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="sph-card p-4 text-center">
                        <div class="mx-auto mb-3 overflow-hidden rounded-circle" style="width: 120px; height: 120px;">
                            @if ($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="thumb-ph w-100 h-100"><i class="bi bi-person-fill fs-1"></i></div>
                            @endif
                        </div>
                        <h6 class="fw-bold mb-2">{{ $guru->nama_guru }}</h6>
                        <span class="chip mb-2">{{ $guru->jabatan }}</span>
                        <p class="text-muted small mb-0">{{ $guru->mapel ?? 'NIP: ' . ($guru->nip ?? '-') }}</p>
                        <a href="{{ route('public.guru.show', $guru) }}" class="stretched-link"></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><p class="text-muted fs-5">Belum ada data guru.</p></div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">{{ $gurus->links() }}</div>
    </div>
</section>
@endsection

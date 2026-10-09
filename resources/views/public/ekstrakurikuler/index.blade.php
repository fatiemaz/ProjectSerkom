@extends('public.template')

@section('title', 'Ekstrakurikuler - SMPN 1 Mangunreja')

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="crumbs"><a href="{{ route('landing') }}">Beranda</a><span>/</span>Ekstrakurikuler</div>
        <h1>Ekstrakurikuler</h1>
        <p>Wadah pengembangan bakat, minat, dan potensi siswa SMPN 1 Mangunreja</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row g-4">
            @forelse ($ekskuls as $ekskul)
                @php $fotoEkskul = $ekskul->gambar ?? $ekskul->foto; @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="sph-card">
                        <div class="zoom" style="height: 210px;">
                            @if ($fotoEkskul && file_exists(public_path('storage/' . $fotoEkskul)))
                                <img src="{{ asset('storage/' . $fotoEkskul) }}" alt="{{ $ekskul->nama_ekskul }}">
                            @else
                                <div class="thumb-ph h-100"><i class="bi bi-activity" style="font-size:2.5rem;"></i></div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h5 class="fw-bold text-primary mb-2">
                                <a href="{{ route('public.ekskul.show', $ekskul) }}" class="ctitle stretched-link text-primary">{{ $ekskul->nama_ekskul }}</a>
                            </h5>
                            <p class="meta mb-3">
                                <i class="bi bi-person-fill me-1"></i> Pembina: {{ $ekskul->pembina ?? '-' }}<br>
                                <i class="bi bi-calendar-event me-1"></i> Jadwal: {{ $ekskul->jadwal_latihan ?? '-' }}
                            </p>
                            <p class="text-secondary small mb-0">{{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 100) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><p class="text-muted fs-5">Belum ada data ekstrakurikuler.</p></div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">{{ $ekskuls->links() }}</div>
    </div>
</section>
@endsection

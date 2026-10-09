@extends('public.template')

@section('title', 'Ekstrakurikuler - SMPN 1 Mangunreja')

@section('content')
<div class="bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Ekstrakurikuler</h1>
        <p class="lead mb-0">Wadah pengembangan bakat, minat, dan potensi siswa SMPN 1 Mangunreja</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse ($ekskuls as $ekskul)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    @if ($ekskul->gambar && file_exists(public_path('storage/' . $ekskul->gambar)))
                        <img src="{{ asset('storage/' . $ekskul->gambar) }}" class="card-img-top" alt="{{ $ekskul->nama_ekskul }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-activity text-primary fs-1"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary">{{ $ekskul->nama_ekskul }}</h5>
                        <p class="card-text text-muted small mb-2">
                            <i class="bi bi-person-fill text-secondary me-1"></i> Pembina: {{ $ekskul->pembina ?? '-' }}<br>
                            <i class="bi bi-calendar-event text-secondary me-1"></i> Jadwal: {{ $ekskul->jadwal_latihan ?? '-' }}
                        </p>
                        <p class="card-text text-secondary">{{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 100) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada data ekstrakurikuler.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $ekskuls->links() }}
    </div>
</div>
@endsection

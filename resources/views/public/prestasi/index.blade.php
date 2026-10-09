@extends('public.template')

@section('content')

<section class="bg-all text-white text-center py-5 mb-4">
    <div class="container py-3">
        <h1 class="fw-bold mb-2">Prestasi Siswa</h1>
        <p class="mb-0 opacity-75">Daftar capaian membanggakan peserta didik kami</p>
    </div>
</section>

<div class="container py-4">
    <div class="row g-4">
        @forelse ($prestasis as $prestasi)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center card-hover rounded-3 overflow-hidden">
                    @if ($prestasi->foto)
                        <img src="{{ asset('storage/' . $prestasi->foto) }}" class="card-img-top" alt="{{ $prestasi->nama_prestasi }}" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-all text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                            <i class="bi bi-trophy-fill fs-1"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-1">{{ Str::limit($prestasi->nama_prestasi, 40) }}</h6>
                        <p class="mb-2 text-muted small">{{ $prestasi->nama_siswa }}</p>
                        <span class="badge bg-primary">{{ $prestasi->tingkat ?? '-' }}</span>
                        <span class="badge bg-secondary">{{ $prestasi->tahun_ajaran }}</span>
                        <a href="{{ route('public.prestasi.show', $prestasi) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-trophy fs-1 d-block mb-2 opacity-50"></i>
                Belum ada prestasi terdaftar.
            </div>
        @endforelse
    </div>

    @if ($prestasis->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $prestasis->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection 

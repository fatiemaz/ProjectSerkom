@extends('public.template')

@section('title', 'Guru & Staf - SMPN 1 Mangunreja')

@section('content')
<div class="bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Guru & Tenaga Kependidikan</h1>
        <p class="lead mb-0">Tenaga pengajar profesional dan berdedikasi tinggi</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse ($gurus as $guru)
            <div class="col-6 col-md-4 col-lg-3 text-center">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-3">
                    <div class="mx-auto mb-3 overflow-hidden rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                        @if ($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-fill text-secondary fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <h6 class="fw-bold mb-1 text-dark">{{ $guru->nama_guru }}</h6>
                    <small class="badge bg-primary bg-opacity-10 text-primary mb-2">{{ $guru->jabatan }}</small>
                    <p class="text-muted small mb-0">{{ $guru->mapel ?? 'NIP: ' . ($guru->nip ?? '-') }}</p>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada data guru.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $gurus->links() }}
    </div>
</div>
@endsection

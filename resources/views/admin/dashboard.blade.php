@extends('admin.index')

@section('contant')

@php $isAdmin = Auth::user()->role === 'Admin'; @endphp

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="card border-0 mb-4"
        style="background: linear-gradient(135deg, #23283a 0%, #4a5178 100%); border-radius: 12px;">
        <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
            <div>
                <h4 class="text-white font-weight-bold mb-1">
                    Selamat Datang, {{ auth()->user()->name }} ! 👋
                </h4>
                <p class="mb-0" style="color: rgba(255,255,255,0.75);">
                    {{ optional($sidebarProfile ?? null)->nama_sekolah ?? 'Sistem Informasi Sekolah' }}
                    &middot; {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
            </div>
            <i class="feather icon-smile d-none d-md-block"
            style="font-size: 56px; color: rgba(255,255,255,0.25);"></i>
        </div>
    </div>

    {{-- PESAN --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <i class="feather icon-alert-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <i class="feather icon-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Dashboard</h4>
        </div>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="row">

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Siswa</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalSiswa }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-users" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Guru</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalGuru }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(0, 188, 212, 0.10);">
                        <i class="feather icon-user-check" style="font-size: 22px; color: #00bcd4;"></i>
                    </div>
                </div>
            </div>
        </div>

        @if ($isAdmin)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body position-relative">
                        <span class="text-muted small">Total User</span>
                        <div class="d-flex align-items-center mt-1">
                            <h3 class="mb-0 font-weight-bold">{{ $totalUser }}</h3>
                        </div>
                        <div class="position-absolute"
                             style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                    display: flex; align-items: center; justify-content: center;
                                    background: rgba(255, 82, 82, 0.10);">
                            <i class="feather icon-shield" style="font-size: 22px; color: #ff5252;"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Berita</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalBerita }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 159, 67, 0.10);">
                        <i class="feather icon-file-text" style="font-size: 22px; color: #ff9f43;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Pengumuman</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalPengumuman }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(40, 199, 111, 0.10);">
                        <i class="feather icon-bell" style="font-size: 22px; color: #28c76f;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Prestasi</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalPrestasi }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-award" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Ekstrakurikuler</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalEkskul }}</h3>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(0, 188, 212, 0.10);">
                        <i class="feather icon-feather" style="font-size: 22px; color: #00bcd4;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- PENGUMUMAN TERBARU + BERITA TERBARU --}}
    <div class="row">

        {{-- PENGUMUMAN TERBARU --}}
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pengumuman Terbaru</h5>
                    <a href="{{ route('pengumuman.index') }}" class="small">Lihat semua</a>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($pengumumanTerbaru as $pengumuman)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold">{{ $pengumuman->judul }}</div>
                                <small class="text-muted">
                                    {{ $pengumuman->tanggal ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d/m/Y') : '' }}
                                </small>
                            </div>
                            @if ($pengumuman->isi)
                                <div class="text-muted small mt-1">
                                    {{ \Illuminate\Support\Str::limit($pengumuman->isi, 90) }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted py-4">
                            Belum ada pengumuman.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- BERITA TERBARU --}}
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Berita Terbaru</h5>
                    <a href="{{ route('berita.index') }}" class="small">Lihat semua</a>
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($beritaTerbaru as $berita)
                        <div class="list-group-item d-flex align-items-center">

                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar"
                                     style="width: 56px; height: 42px; border-radius: 6px; object-fit: cover;"
                                     class="mr-3">
                            @else
                                <div class="mr-3 d-flex align-items-center justify-content-center"
                                     style="width: 56px; height: 42px; border-radius: 6px;
                                            background: rgba(114, 103, 239, 0.10);">
                                    <i class="feather icon-image" style="color: #7267ef;"></i>
                                </div>
                            @endif

                            <div>
                                <div class="font-weight-bold">{{ $berita->judul }}</div>
                                <small class="text-muted">
                                    {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d/m/Y') : '' }}
                                </small>
                            </div>

                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted py-4">
                            Belum ada berita.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

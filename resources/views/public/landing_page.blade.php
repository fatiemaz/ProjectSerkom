@extends('public.template')

@section('content')

{{-- CAROUSEL HERO --}}
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" style="height: 480px;">
            <img src="{{ asset('assets/img/sekolah2.png') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Sekolah">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-4 p-4 mb-4">
                <h2 class="fw-bold text-white">Selamat Datang di {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h2>
                <p class="lead mb-0">Membentuk Generasi Cerdas, Berkarakter, dan Berprestasi</p>
            </div>
        </div>
    </div>
</div>

{{-- SECTION STATISTIK --}}
<section class="py-5 bg-primary text-white shadow-sm">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <div class="p-3 bg-white rounded-3 shadow-sm text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-primary">{{ $stats['siswa'] ?? 0 }}</h3>
                    <small class="text-muted fw-semibold">Siswa Aktif</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 bg-white rounded-3 shadow-sm text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-badge-fill fs-3"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-primary">{{ $stats['guru'] ?? 0 }}</h3>
                    <small class="text-muted fw-semibold">Guru & Staf</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 bg-white rounded-3 shadow-sm text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-trophy-fill fs-3"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-primary">{{ $stats['prestasi'] ?? 0 }}</h3>
                    <small class="text-muted fw-semibold">Prestasi Diraih</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 bg-white rounded-3 shadow-sm text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-activity fs-3"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-primary">{{ $stats['ekskul'] ?? 0 }}</h3>
                    <small class="text-muted fw-semibold">Ekstrakurikuler</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION PROFIL SEKOLAH --}}
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                @if ($profil?->foto && file_exists(public_path('storage/' . $profil->foto)))
                    <img src="{{ asset('storage/' . $profil->foto) }}" alt="{{ $profil->nama_sekolah }}" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 380px; object-fit: cover;">
                @else
                    <div class="bg-primary text-white rounded-4 shadow-lg d-flex align-items-center justify-content-center" style="height: 340px;">
                        <i class="bi bi-building fs-1"></i>
                    </div>
                @endif
            </div>
            <div class="col-lg-7">
                <span class="badge bg-success px-3 py-2 rounded-pill mb-2">Mengenal Lebih Dekat</span>
                <h2 class="fw-bold text-primary">Profil {{ $profil->nama_sekolah ?? 'Sekolah' }}</h2>
                <div class="bg-success rounded-pill mb-3" style="width: 50px; height: 4px;"></div>

                <p class="text-secondary lh-lg mb-4">
                    {!! nl2br(e($profil->deskripsi ?? 'Profil sekolah belum diisi.')) !!}
                </p>

                <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">{{ $profil->kepala_sekolah ?? '-' }}</h6>
                        <small class="text-muted">Kepala Sekolah</small>
                    </div>
                    <a href="{{ route('public.profil') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION BERITA + PENGUMUMAN (KOLOM BERDAMPINGAN) --}}
<section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="row g-4">

            {{-- BERITA UTAMA (KOLOM KIRI - col-lg-8) --}}
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <div>
                        <h3 class="fw-bold text-primary mb-1">Berita Terbaru</h3>
                        <div class="bg-primary rounded-pill" style="width: 40px; height: 3px;"></div>
                    </div>
                    <a href="{{ route('public.berita') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>

                <div class="row g-3">
                    @forelse ($beritas as $berita)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm card-hover rounded-3 overflow-hidden">
                                @if ($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 160px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 160px;">
                                        <i class="bi bi-newspaper fs-1 text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column p-3">
                                    <small class="text-muted mb-2"><i class="bi bi-calendar3 me-1"></i> {{ $berita->created_at->translatedFormat('d F Y') }}</small>
                                    <h6 class="card-title fw-bold">
                                        <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-dark text-decoration-none stretched-link">
                                            {{ Str::limit($berita->judul, 45) }}
                                        </a>
                                    </h6>
                                    <p class="card-text text-muted small mt-auto" style="font-size: 0.8rem;">{{ Str::limit(strip_tags($berita->isi), 70) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-muted small py-3">Belum ada berita dipublikasikan.</div>
                    @endforelse
                </div>
            </div>

            {{-- WIDGET PENGUMUMAN (KOLOM KANAN - col-lg-4) --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                    <div class="card-header bg-primary text-white py-2 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                            <i class="bi bi-megaphone-fill text-warning"></i>
                            Pengumuman Terbaru
                        </h6>
                        <a href="{{ route('public.pengumuman') }}" class="text-white text-decoration-none" style="font-size: 0.78rem;">
                            Semua <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>

                    <div class="card-body p-2 d-flex flex-column justify-content-start">
                        <div class="d-flex flex-column gap-2">
                            @forelse ($pengumumans as $pengumuman)
                                <div class="p-2 bg-light rounded border-start border-3 border-primary shadow-sm card-hover">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <span class="text-muted" style="font-size: 0.72rem;">
                                            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d M Y') }}
                                        </span>
                                        @if(!empty($pengumuman->lampiran))
                                            <span class="badge bg-info text-dark py-1 px-1" style="font-size: 0.65rem;">
                                                <i class="bi bi-paperclip"></i> Lampiran
                                            </span>
                                        @endif
                                    </div>
                                    <h6 class="fw-bold mb-1" style="font-size: 0.85rem; line-height: 1.3;">
                                        <a href="{{ route('public.pengumuman.show', $pengumuman) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($pengumuman->judul, 45) }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-1 text-truncate" style="font-size: 0.78rem;">
                                        {{ strip_tags($pengumuman->isi) }}
                                    </p>
                                    <a href="{{ route('public.pengumuman.show', $pengumuman) }}" class="text-primary fw-semibold text-decoration-none d-inline-block" style="font-size: 0.75rem;">
                                        Lihat Detail <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-bell-slash fs-4 d-block mb-1"></i>
                                    <small style="font-size: 0.78rem;">Belum ada pengumuman terbaru.</small>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-footer bg-white text-center p-2 border-top mt-auto">
                        <a href="{{ route('public.pengumuman') }}" class="btn btn-outline-primary btn-sm w-100 fw-semibold" style="font-size: 0.78rem;">
                            <i class="bi bi-list-ul me-1"></i> Arsip Pengumuman
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- SECTION PRESTASI SISWA (KEMBALI FULL CENTER) --}}
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-1">Prestasi Siswa</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4">
            @forelse ($prestasis as $prestasi)
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm text-center card-hover rounded-3 overflow-hidden p-3">
                        <div class="card-body p-0">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                <i class="bi bi-trophy-fill fs-4"></i>
                            </div>
                            <h6 class="fw-bold mb-1 small">{{ Str::limit($prestasi->nama_prestasi, 35) }}</h6>
                            <p class="mb-2 text-muted small">{{ $prestasi->nama_siswa }}</p>
                            <span class="badge bg-primary me-1">{{ $prestasi->tingkat ?? '-' }}</span>
                            <span class="badge bg-secondary">{{ $prestasi->tahun_ajaran ?? $prestasi->tahun }}</span>
                            <a href="{{ route('public.prestasi.show', $prestasi) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada data prestasi.</div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('public.prestasi') }}" class="btn btn-outline-primary px-4 rounded-pill">Lihat Semua Prestasi <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

{{-- SECTION EKSTRAKURIKULER (FULL CENTER) --}}
<section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-1">Ekstrakurikuler</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4">
            @forelse ($ekskuls as $ekskul)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card h-100 border-0 shadow-sm card-hover text-center rounded-3 overflow-hidden">
                        @if (!empty($ekskul->foto))
                            <img src="{{ asset('storage/' . $ekskul->foto) }}" class="card-img-top" style="height: 110px; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 110px;">
                                <i class="bi bi-dribbble fs-2"></i>
                            </div>
                        @endif
                        <div class="card-body p-2">
                            <h6 class="fw-bold mb-1 small">
                                <a href="{{ route('public.ekskul.show', $ekskul) }}" class="text-dark text-decoration-none stretched-link">
                                    {{ $ekskul->nama_ekskul }}
                                </a>
                            </h6>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Pembina: {{ $ekskul->pembina ?? '-' }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada ekstrakurikuler terdaftar.</div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('public.ekskul') }}" class="btn btn-outline-primary px-4 rounded-pill">Lihat Semua Ekstrakurikuler <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

{{-- SECTION GURU & STAF (FULL CENTER) --}}
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-1">Guru & Staf Pengajar</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4">
            @forelse ($gurus as $guru)
                <div class="col-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm text-center card-hover rounded-3 overflow-hidden p-3">
                        @if (!empty($guru->foto))
                            <img src="{{ asset('storage/' . $guru->foto) }}" class="rounded-circle mx-auto mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 80px; height: 80px;">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        @endif
                        <div class="card-body p-0">
                            <h6 class="fw-bold mb-1 text-truncate" style="font-size: 0.9rem;">{{ $guru->nama }}</h6>
                            <small class="text-primary d-block font-weight-semibold" style="font-size: 0.8rem;">{{ $guru->mapel ?? $guru->jabatan ?? '-' }}</small>
                            <a href="{{ route('public.guru.show', $guru) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada data guru.</div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('public.guru') }}" class="btn btn-outline-primary px-4 rounded-pill">Lihat Semua Guru <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

{{-- SECTION GALERI FOTO (FULL CENTER) --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-1">Galeri Foto Kegiatan</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-3">
            @forelse ($galeris as $galeri)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('public.galeri.show', $galeri) }}" class="d-block card-hover rounded-3 overflow-hidden border shadow-sm">
                        @if (!empty($galeri->foto))
                            <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-100" style="height: 160px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 160px;">
                                <i class="bi bi-image text-muted fs-2"></i>
                            </div>
                        @endif
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada foto galeri.</div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('public.galeri') }}" class="btn btn-outline-primary px-4 rounded-pill">Lihat Semua Galeri <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

@endsection

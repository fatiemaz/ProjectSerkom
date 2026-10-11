@extends('public.template')

@section('content')

{{-- HERO VIDEO --}}
<section class="hero hero-center">
    <img src="{{ asset('assets/img/sekolah2.png') }}" alt="{{ $profil->nama_sekolah ?? 'Sekolah' }}">
    @if (!empty($profil?->video))
        <video class="hero-video" autoplay muted loop playsinline
               poster="{{ asset('assets/img/sekolah2.png') }}">
            <source src="{{ asset('storage/' . $profil->video) }}" type="video/mp4">
        </video>
    @endif
    <div class="container" data-aos="fade-right">
        <div class="row">
            <div class="col-lg-7">
                <span class="eyebrow light">Selamat Datang di {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
                <h1 class="mb-3">Membentuk Generasi Cerdas, Berkarakter, dan Berprestasi</h1>
                <p class="lead mb-0">Lingkungan belajar yang kondusif untuk tumbuh, berprestasi, dan berkarakter.</p>
            </div>
        </div>
    </div>
</section>

{{-- SEKILAS --}}
<section class="sec" data-aos="fade-up">
    <div class="container">
        <div class="mb-5">
            <span class="eyebrow">Sekilas Sekolah</span>
            <h2 class="sec-title">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }} dalam Angka</h2>
        </div>
        <div class="row g-4">
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="stat-num" data-count="{{ $stats['siswa'] ?? 0 }}">{{ $stats['siswa'] ?? 0 }}</div><div class="stat-label">Siswa Aktif</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="stat-num" data-count="{{ $stats['guru'] ?? 0 }}">{{ $stats['guru'] ?? 0 }}</div><div class="stat-label">Guru &amp; Staf</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="stat-num" data-count="{{ $stats['prestasi'] ?? 0 }}">{{ $stats['prestasi'] ?? 0 }}</div><div class="stat-label">Prestasi Diraih</div></div></div>
            <div class="col-6 col-lg-3"><div class="stat-item"><div class="stat-num" data-count="{{ $stats['ekskul'] ?? 0 }}">{{ $stats['ekskul'] ?? 0 }}</div><div class="stat-label">Ekstrakurikuler</div></div></div>
        </div>
    </div>
</section>

{{-- PROFIL --}}
<section class="sec sec-soft">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-up-left">
                @if ($profil?->foto && file_exists(public_path('storage/' . $profil->foto)))
                    <img src="{{ asset('storage/' . $profil->foto) }}" alt="{{ $profil->nama_sekolah }}" class="frame-img" style="max-height: 400px;">
                @else
                    <div class="thumb-ph frame-img" style="height: 340px;"><i class="bi bi-building" style="font-size:4rem;"></i></div>
                @endif
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-up-right">
                <span class="eyebrow">Mengenal Lebih Dekat</span>
                <h2 class="sec-title mb-3">Profil {{ $profil->nama_sekolah ?? 'Sekolah' }}</h2>
                <p class="text-secondary lh-lg mb-4">{!! nl2br(e(Str::limit($profil->deskripsi ?? 'Profil sekolah belum diisi.', 600))) !!}</p>
                <div class="d-flex flex-wrap align-items-center gap-4">
                    <div>
                        <div class="fw-bold">{{ $profil->kepala_sekolah ?? '-' }}</div>
                        <small class="text-muted">Kepala Sekolah</small>
                    </div>
                    <a href="{{ route('public.profil') }}" class="btn-sph">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FASILITAS (kartu bisa dibalik) --}}
@if ($fasilitas->isNotEmpty())
    <section class="sec">
        <div class="container" data-aos="fade-up">
            <div class="mb-5">
                <span class="eyebrow">Fasilitas</span>
                <h2 class="sec-title">Sarana Penunjang Belajar</h2>
            </div>

            <div class="row g-3">
                @foreach ($fasilitas as $f)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="flip ratio" style="--bs-aspect-ratio: 125%;" tabindex="0" role="button"
                            aria-label="Lihat detail {{ $f->nama }}">
                            <div class="flip-inner">

                                {{-- DEPAN: foto --}}
                                <div class="flip-face rounded-4 overflow-hidden shadow-sm bg-all text-white">
                                    @if ($f->foto)
                                        <img src="{{ asset('storage/' . $f->foto) }}" alt="{{ $f->nama }}"
                                            class="w-100 h-100 rounded-4" style="object-fit: cover;">
                                    @else
                                        <div class="d-flex h-100 align-items-center justify-content-center">
                                            <i class="bi bi-building fs-1"></i>
                                        </div>
                                    @endif
                                    <span class="position-absolute bottom-0 end-0 m-2 badge rounded-pill text-bg-dark opacity-75">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </span>
                                </div>

                                {{-- BELAKANG: nama dan deskripsi --}}
                                <div class="flip-face flip-back rounded-4 shadow-sm text-white p-3 d-flex flex-column justify-content-center text-center overflow-auto"
                                    style="background: #0a2a7a;">
                                    <h6 class="fw-bold mb-2">{{ $f->nama }}</h6>
                                    <p class="small mb-0 opacity-75">{{ $f->deskripsi ?: 'Belum ada deskripsi.' }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- BERITA --}}
<section class="sec sec-soft" data-aos="fade-up">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <span class="eyebrow">Berita</span>
                <h2 class="sec-title mb-0">Berita Terbaru</h2>
            </div>
            <a href="{{ route('public.berita') }}" class="link-arrow">Berita Lainnya <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-4">
            @forelse ($beritas as $berita)
                <div class="col-md-6 col-lg-4">
                    <div class="sph-card d-flex flex-column">
                        <div class="zoom" style="height: 210px;">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                            @else
                                <div class="thumb-ph h-100"><i class="bi bi-newspaper" style="font-size:2.5rem;"></i></div>
                            @endif
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <span class="meta mb-2"><i class="bi bi-calendar3 me-1"></i> {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                            <h5 class="mb-2"><a href="{{ route('public.berita.show', $berita->slug) }}" class="ctitle stretched-link">{{ Str::limit($berita->judul, 60) }}</a></h5>
                            <p class="text-muted small mb-0 mt-auto">{{ Str::limit(strip_tags($berita->isi), 90) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted text-center py-4">Belum ada berita dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- PENGUMUMAN --}}
<section class="sec">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4" data-aos="fade-up-right">
                <span class="eyebrow">Pengumuman</span>
                <h2 class="sec-title mb-3">Informasi Resmi Sekolah</h2>
                <p class="sec-sub mb-4">Pantau pengumuman terbaru agar tidak ketinggalan informasi penting dari sekolah.</p>
                <a href="{{ route('public.pengumuman') }}" class="btn-sph-o">Arsip Pengumuman</a>
            </div>
            <div class="col-lg-8" data-aos="fade-up-left">
                <div class="d-flex flex-column gap-3">
                    @forelse ($pengumumans as $pengumuman)
                        @php $tgl = \Carbon\Carbon::parse($pengumuman->created_at); @endphp
                        <div class="row-item">
                            <div class="date-box"><b>{{ $tgl->format('d') }}</b><small>{{ $tgl->translatedFormat('M Y') }}</small></div>
                            <div class="flex-grow-1" style="min-width:0;">
                                <h6 class="fw-bold mb-1">
                                    <a href="{{ route('public.pengumuman.show', $pengumuman) }}" class="ctitle stretched-link">{{ Str::limit($pengumuman->judul, 70) }}</a>
                                    @if(!empty($pengumuman->lampiran))<span class="chip chip-gold ms-1"><i class="bi bi-paperclip"></i> Lampiran</span>@endif
                                </h6>
                                <p class="text-muted small mb-0 text-truncate">{{ strip_tags($pengumuman->isi) }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4"><i class="bi bi-bell-slash fs-3 d-block mb-1"></i>Belum ada pengumuman terbaru.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PRESTASI --}}
<section class="sec sec-soft" >
    <div class="container" data-aos="fade-up">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <span class="eyebrow">Prestasi</span>
                <h2 class="sec-title mb-0">Kisah Prestasi Siswa</h2>
            </div>
            <a href="{{ route('public.prestasi') }}" class="link-arrow">Semua Prestasi <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            @forelse ($prestasis as $prestasi)
                <div class="col-6 col-lg-3">
                    <div class="sph-card p-4 text-center">
                        <div class="thumb-ph rounded-circle mx-auto mb-3" style="width:64px;height:64px;"><i class="bi bi-trophy-fill fs-3"></i></div>
                        <h6 class="fw-bold mb-1">{{ Str::limit($prestasi->nama_prestasi, 40) }}</h6>
                        <p class="text-muted small mb-3">{{ $prestasi->nama_siswa }}</p>
                        <span class="chip">{{ $prestasi->tingkat ?? '-' }}</span>
                        <span class="chip chip-gold">{{ $prestasi->tahun_ajaran ?? $prestasi->tahun }}</span>
                        <a href="{{ route('public.prestasi.show', $prestasi) }}" class="stretched-link"></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada data prestasi.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- EKSTRAKURIKULER --}}
<section class="sec">
    <div class="container" data-aos="fade-up">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <span class="eyebrow">Ekstrakurikuler</span>
                <h2 class="sec-title mb-0">Satu Sekolah, Banyak Minat</h2>
            </div>
            <a href="{{ route('public.ekskul') }}" class="link-arrow">Semua Ekstrakurikuler <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            @forelse ($ekskuls as $ekskul)
                @php $fotoEkskul = $ekskul->gambar ?? $ekskul->foto; @endphp
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('public.ekskul.show', $ekskul) }}" class="photo-tile">
                        @if (!empty($fotoEkskul))
                            <img src="{{ asset('storage/' . $fotoEkskul) }}" alt="{{ $ekskul->nama_ekskul }}">
                        @else
                            <div class="ph"><i class="bi bi-dribbble"></i></div>
                        @endif
                        <div class="cap"><h6>{{ $ekskul->nama_ekskul }}</h6><small>Pembina: {{ $ekskul->pembina ?? '-' }}</small></div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada ekstrakurikuler terdaftar.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- GURU --}}
<section class="sec sec-soft" data-aos="fade-up">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <span class="eyebrow">Tenaga Pendidik</span>
                <h2 class="sec-title mb-0">Guru &amp; Staf Pengajar</h2>
            </div>
            <a href="{{ route('public.guru') }}" class="link-arrow">Semua Guru <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            @forelse ($gurus as $guru)
                <div class="col-6 col-lg-3">
                    <div class="sph-card p-4 text-center">
                        @if (!empty($guru->foto))
                            <img src="{{ asset('storage/' . $guru->foto) }}" class="rounded-circle mx-auto mb-3 d-block" style="width:96px;height:96px;object-fit:cover;" alt="">
                        @else
                            <div class="thumb-ph rounded-circle mx-auto mb-3" style="width:96px;height:96px;"><i class="bi bi-person fs-1"></i></div>
                        @endif
                        <h6 class="fw-bold mb-1 text-truncate">{{ $guru->nama_guru ?? $guru->nama }}</h6>
                        <small class="text-muted">{{ $guru->mapel ?? $guru->jabatan ?? '-' }}</small>
                        <a href="{{ route('public.guru.show', $guru) }}" class="stretched-link"></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada data guru.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- GALERI --}}
<section class="sec">
    <div class="container" data-aos="fade-up">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
            <div>
                <span class="eyebrow">Galeri</span>
                <h2 class="sec-title mb-0">Momen Kegiatan Kami</h2>
            </div>
            <a href="{{ route('public.galeri') }}" class="link-arrow">Semua Galeri <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            @forelse ($galeris as $galeri)
                @php $fotoGaleri = $galeri->file ?? $galeri->foto; @endphp
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('public.galeri.show', $galeri) }}" class="photo-tile sq">
                        @if (!empty($fotoGaleri) && ($galeri->kategori ?? 'Foto') !== 'Video')
                            <img src="{{ asset('storage/' . $fotoGaleri) }}" alt="{{ $galeri->judul }}">
                        @else
                            <div class="ph"><i class="bi bi-play-circle"></i></div>
                        @endif
                        <div class="cap"><h6 class="small">{{ Str::limit($galeri->judul, 40) }}</h6></div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada foto galeri.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection

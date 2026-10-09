<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --bs-primary: #0a2a7a;
            --bs-primary-rgb: 10, 42, 122;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .bg-all {
            background: linear-gradient(135deg, #0a2a7a 40%, #129759 100%);
        }

        .navbar {
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
        }

        .section-title {
            font-weight: 700;
            color: #0a2a7a;
        }

        .section-line {
            width: 60px;
            height: 4px;
            background: #129759;
            margin: 10px auto 25px;
            border-radius: 2px;
        }

        footer a:hover {
            opacity: 0.85;
            padding-left: 4px;
            transition: all 0.2s ease;
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-all fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('landing') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="32" height="32" class="d-inline-block align-text-top">
                <span>{{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing') ? 'active fw-bold' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.profil*') ? 'active fw-bold' : '' }}" href="{{ route('public.profil') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.prestasi*') ? 'active fw-bold' : '' }}" href="{{ route('public.prestasi') }}">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.ekskul*') ? 'active fw-bold' : '' }}" href="{{ route('public.ekskul') }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.guru*') ? 'active fw-bold' : '' }}" href="{{ route('public.guru') }}">Guru & Staf</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.berita*') ? 'active fw-bold' : '' }}" href="{{ route('public.berita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.pengumuman*') ? 'active fw-bold' : '' }}" href="{{ route('public.pengumuman') }}">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.galeri*') ? 'active fw-bold' : '' }}" href="{{ route('public.galeri') }}">Galeri</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main style="padding-top: 50px; min-height: 80vh;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="pt-5 pb-3 text-white bg-all mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="40">
                        <h5 class="fw-bold mb-0">{{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h5>
                    </div>
                    <p class="small text-white-50 lh-base">
                        {{ Str::limit(strip_tags($profilGlobal->deskripsi ?? 'Mewujudkan generasi cerdas, berkarakter, dan berprestasi unggul dalam lingkungan belajar yang kondusif.'), 180) }}
                    </p>
                </div>

                <div class="col-md-3">
                    <h6 class="fw-semibold mb-3 border-bottom border-white-50 pb-2">Navigasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('landing') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Beranda</a></li>
                        <li><a href="{{ route('public.profil') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Profil Sekolah</a></li>
                        <li><a href="{{ route('public.prestasi') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Prestasi Siswa</a></li>
                        <li><a href="{{ route('public.ekskul') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Ekstrakurikuler</a></li>
                        <li><a href="{{ route('public.guru') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Guru & Staf</a></li>
                        <li><a href="{{ route('public.berita') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Berita & Informasi</a></li>
                        <li><a href="{{ route('public.galeri') }}" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Galeri Foto</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6 class="fw-semibold mb-3 border-bottom border-white-50 pb-2">Kontak</h6>
                    <p class="small mb-2"><i class="bi bi-geo-alt-fill me-2"></i> {{ $profilGlobal->alamat ?? 'Jl. Raya Mangunreja, Tasikmalaya' }}</p>
                    <p class="small mb-2"><i class="bi bi-whatsapp me-2"></i> {{ $profilGlobal->kontak ?? '08XXXXXXXXXX' }}</p>
                    <p class="small mb-3"><i class="bi bi-envelope-fill me-2"></i> {{ $profilGlobal->email ?? 'info@smpn1mangunreja.sch.id' }}</p>

                    <div class="d-flex gap-3 fs-5">
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <hr class="border-light opacity-25 my-4">

            <div class="text-center small text-white-50">
                &copy; {{ date('Y') }} {{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="preload" href="{{ asset('assets/fonts/plus-jakarta-sans-latin-wght-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/aos-master/dist/aos.css') }}">
</head>
<body>

    {{-- NAVBAR --}}
    <header class="sph-nav fixed-top">
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="42">
                    <span>{{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.profil*') ? 'active' : '' }}" href="{{ route('public.profil') }}">Profil</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.prestasi*') ? 'active' : '' }}" href="{{ route('public.prestasi') }}">Prestasi</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.ekskul*') ? 'active' : '' }}" href="{{ route('public.ekskul') }}">Ekstrakurikuler</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.guru*') ? 'active' : '' }}" href="{{ route('public.guru') }}">Guru &amp; Staf</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.siswa*') ? 'active' : '' }}"href="{{ route('public.siswa') }}">Siswa</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.berita*') ? 'active' : '' }}" href="{{ route('public.berita') }}">Berita</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.pengumuman*') ? 'active' : '' }}" href="{{ route('public.pengumuman') }}">Pengumuman</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.galeri*') ? 'active' : '' }}" href="{{ route('public.galeri') }}">Galeri</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.profile_pribadi*') ? 'active' : '' }}" href="{{ route('public.profile_pribadi') }}">Profile Pribadi</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- KONTEN UTAMA --}}
    <main style="padding-top: 76px; min-height: 80vh;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="sph-footer" id="kontak">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="48">
                        <h5 class="fw-bold text-white mb-0">{{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h5>
                    </div>
                    <p class="small lh-lg" style="color:#aab6cf;">
                        {{ Str::limit(strip_tags($profilGlobal->deskripsi ?? 'Mewujudkan generasi cerdas, berkarakter, dan berprestasi unggul dalam lingkungan belajar yang kondusif.'), 180) }}
                    </p>
                    <div class="social d-flex gap-2 mt-3">
                        <a href="https://www.instagram.com/smpn1mangunrejaa?obrf=cHhqbm53aDlweDky"><i class="bi bi-instagram"></i></a>
                        <a href="https://youtube.com/@smpmangunreja1259?si=RjrYOIyGjjXNH9E5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Tentang</h6>
                    <ul>
                        <li><a href="{{ route('public.profil') }}">Profil Sekolah</a></li>
                        <li><a href="{{ route('public.guru') }}">Guru &amp; Staf</a></li>
                        <li><a href="{{ route('public.ekskul') }}">Ekstrakurikuler</a></li>
                        <li><a href="{{ route('public.prestasi') }}">Prestasi Siswa</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Informasi</h6>
                    <ul>
                        <li><a href="{{ route('public.berita') }}">Berita</a></li>
                        <li><a href="{{ route('public.pengumuman') }}">Pengumuman</a></li>
                        <li><a href="{{ route('public.galeri') }}">Galeri Foto</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h6>Hubungi Kami</h6>
                    <ul>
                        <li class="d-flex gap-2"><i class="bi bi-geo-alt-fill text-warning"></i> <span>{{ $profilGlobal->alamat ?? 'Jl. Raya Mangunreja, Tasikmalaya' }}</span></li>
                        <li class="d-flex gap-2"><i class="bi bi-whatsapp text-warning"></i> <span>{{ $profilGlobal->kontak ?? '0265546408' }}</span></li>
                        <li class="d-flex gap-2"><i class="bi bi-envelope-fill text-warning"></i> <span>{{ $profilGlobal->email ?? 'smpn1mgrj@gmail.com' }}</span></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4" style="border-color: rgba(255,255,255,.15); opacity: 1;">

            <div class="text-center small" style="color:#8e9bb8;">
                &copy; {{ date('Y') }} {{ $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja' }}. Hak cipta dilindungi.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/aos-master/dist/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            offset: 80,
            disable: function () {
                return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            }
        });
    </script>
</body>
</html>

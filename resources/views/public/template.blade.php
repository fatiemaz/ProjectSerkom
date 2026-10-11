<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $profilGlobal->nama_sekolah ?? 'SMPN 1 Mangunreja')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --bs-primary: #0b2c6b;
            --bs-primary-rgb: 11, 44, 107;
            --navy: #0b2c6b;
            --navy-dk: #071c47;
            --gold: #f2a900;
            --gold-dk: #a56f00;
            --ink: #1a2333;
            --muted: #5f6c80;
            --soft: #f4f6fa;
            --line: #e4e9f1;
            --bs-body-color: #1a2333;
            --bs-link-color: #0b2c6b;
        }

        body { font-family: 'Plus Jakarta Sans', system-ui, 'Segoe UI', sans-serif; color: var(--ink); background: #fff; }
        h1, h2, h3, h4, h5, h6 { letter-spacing: -.01em; }
        a { transition: color .2s; }

        /* NAVBAR */
        .sph-nav { background: #fff; border-bottom: 1px solid var(--line); }
        .sph-nav .navbar { min-height: 76px; }
        .sph-nav .navbar-brand { color: var(--navy); font-weight: 800; font-size: 1.05rem; line-height: 1.15; max-width: 260px; white-space: normal; }
        .sph-nav .nav-link { color: var(--ink); font-weight: 600; font-size: .9rem; padding: .5rem .8rem; position: relative; }
        .sph-nav .nav-link::after { content: ""; position: absolute; left: .8rem; right: .8rem; bottom: 2px; height: 2px; background: var(--gold); transform: scaleX(0); transition: transform .25s; }
        .sph-nav .nav-link:hover::after, .sph-nav .nav-link.active::after { transform: scaleX(1); }
        .sph-nav .nav-link.active, .sph-nav .nav-link:hover { color: var(--navy); }

        /* TOMBOL */
        .btn-sph, .btn-sph-o, .btn-gold, .btn-light-o { border-radius: 999px; padding: .65rem 1.5rem; font-weight: 700; border: 2px solid transparent; transition: all .25s; display: inline-block; text-decoration: none; }
        .btn-sph { background: var(--navy); border-color: var(--navy); color: #fff; }
        .btn-sph:hover { background: var(--navy-dk); border-color: var(--navy-dk); color: #fff; }
        .btn-sph-o { border-color: var(--navy); color: var(--navy); background: transparent; }
        .btn-sph-o:hover { background: var(--navy); color: #fff; }
        .btn-gold { background: var(--gold); border-color: var(--gold); color: var(--ink); }
        .btn-gold:hover { background: #ffc233; border-color: #ffc233; color: var(--ink); }
        .btn-light-o { border-color: #fff; color: #fff; background: transparent; }
        .btn-light-o:hover { background: #fff; color: var(--navy); }
        .btn-sm-pill { padding: .4rem 1rem; font-size: .85rem; }

        /* TIPOGRAFI & SECTION */
        .sec { padding: 5rem 0; }
        .sec-soft { background: var(--soft); }
        .eyebrow { display: inline-block; font-size: .76rem; font-weight: 800; letter-spacing: .15em; text-transform: uppercase; color: var(--gold-dk); margin-bottom: .6rem; }
        .on-dark .eyebrow, .eyebrow.light { color: var(--gold); }
        .sec-title { font-weight: 800; color: var(--navy); font-size: clamp(1.7rem, 3vw, 2.5rem); line-height: 1.2; }
        .sec-sub { color: var(--muted); max-width: 640px; }
        .link-arrow { font-weight: 700; color: var(--navy); text-decoration: none; }
        .link-arrow i { display: inline-block; transition: transform .2s; }
        .link-arrow:hover i { transform: translateX(5px); }
        .prose { line-height: 1.9; color: #33405a; font-size: 1.04rem; }

        /* HERO BERANDA */
        .hero { position: relative; height: 82vh; min-height: 540px; max-height: 780px; color: #fff; display: flex; align-items: center; overflow: hidden; }
        .hero > img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .hero::before { content: ""; position: absolute; inset: 0; z-index: 1; background: linear-gradient(90deg, rgba(7,28,71,.9) 0%, rgba(7,28,71,.6) 55%, rgba(7,28,71,.2) 100%); }
        .hero .container { position: relative; z-index: 2; }
        .hero h1 { font-weight: 800; font-size: clamp(2.2rem, 5vw, 3.8rem); line-height: 1.1; }
        .hero-note { background: rgba(255,255,255,.96); color: var(--ink); border-radius: 18px; padding: 1.4rem; border-top: 5px solid var(--gold); box-shadow: 0 20px 50px rgba(0,0,0,.25); }

        /* HERO HALAMAN DALAM */
        .page-hero { background: linear-gradient(120deg, var(--navy-dk), var(--navy)); color: #fff; padding: 3.5rem 0 3rem; position: relative; overflow: hidden; }
        .page-hero::after { content: ""; position: absolute; right: -90px; top: -90px; width: 330px; height: 330px; border-radius: 50%; background: rgba(242,169,0,.18); }
        .page-hero .container { position: relative; z-index: 1; }
        .page-hero h1 { font-weight: 800; font-size: clamp(1.8rem, 4vw, 2.8rem); margin-bottom: .5rem; }
        .page-hero p { opacity: .82; margin: 0; max-width: 650px; }
        .crumbs { font-size: .82rem; opacity: .85; margin-bottom: .9rem; }
        .crumbs a { color: #fff; text-decoration: none; }
        .crumbs span { margin: 0 .5rem; }

        /* KARTU */
        .sph-card { background: #fff; border: 1px solid var(--line); border-radius: 18px; overflow: hidden; transition: all .3s ease; height: 100%; position: relative; }
        .sph-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(11,44,107,.14); border-color: transparent; }
        .zoom { overflow: hidden; }
        .zoom img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
        .sph-card:hover .zoom img, .zoom:hover img { transform: scale(1.07); }
        .thumb-ph { display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #e6edf9, #f7f9fc); color: var(--navy); }
        .chip { display: inline-block; font-size: .72rem; font-weight: 700; padding: .3rem .75rem; border-radius: 999px; background: rgba(11,44,107,.08); color: var(--navy); }
        .chip-gold { background: rgba(242,169,0,.2); color: #7a5200; }
        .meta { font-size: .8rem; color: var(--muted); }
        .ctitle { font-weight: 700; color: var(--ink); text-decoration: none; line-height: 1.35; }
        .ctitle:hover { color: var(--navy); }

        /* STATISTIK */
        .stat-item { border-left: 3px solid var(--gold); padding-left: 1.1rem; }
        .stat-num { font-size: clamp(2.4rem, 5vw, 3.6rem); font-weight: 800; color: var(--navy); line-height: 1; }
        .stat-label { color: var(--muted); font-weight: 600; margin-top: .4rem; }

        /* TILE JELAJAH */
        .tile { display: block; padding: 2rem 1.6rem; border-radius: 18px; background: var(--navy); color: #fff; text-decoration: none; height: 100%; transition: all .3s; }
        .tile:hover { background: var(--navy-dk); transform: translateY(-6px); color: #fff; box-shadow: 0 18px 40px rgba(11,44,107,.3); }
        .tile .big { font-size: 2.4rem; color: var(--gold); }
        .tile h5 { font-weight: 800; margin: 1rem 0 .4rem; }
        .tile p { opacity: .8; font-size: .9rem; margin-bottom: 1rem; }

        /* TILE FOTO (EKSKUL / GALERI) */
        .photo-tile { position: relative; display: block; border-radius: 18px; overflow: hidden; aspect-ratio: 4 / 5; background: var(--navy); color: #fff; text-decoration: none; }
        .photo-tile.sq { aspect-ratio: 1 / 1; }
        .photo-tile img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
        .photo-tile:hover img { transform: scale(1.08); }
        .photo-tile .cap { position: absolute; left: 0; right: 0; bottom: 0; padding: 2.5rem 1rem 1rem; background: linear-gradient(0deg, rgba(7,28,71,.92), transparent); }
        .photo-tile .cap h6 { font-weight: 800; margin: 0; }
        .photo-tile .cap small { opacity: .8; }
        .photo-tile .ph { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: var(--gold); }

        /* PENGUMUMAN */
        .date-box { width: 64px; flex: none; text-align: center; background: var(--navy); color: #fff; border-radius: 12px; padding: .55rem 0; }
        .date-box b { display: block; font-size: 1.4rem; line-height: 1; }
        .date-box small { font-size: .68rem; text-transform: uppercase; letter-spacing: .08em; opacity: .85; }
        .row-item { display: flex; gap: 1rem; padding: 1.1rem 1.2rem; background: #fff; border: 1px solid var(--line); border-radius: 16px; transition: all .25s; }
        .row-item:hover { box-shadow: 0 10px 28px rgba(11,44,107,.12); transform: translateX(4px); }

        /* GAMBAR BERBINGKAI */
        .frame-img { border-radius: 20px; box-shadow: 14px 14px 0 rgba(242,169,0,.9); width: 100%; object-fit: cover; }

        /* CTA */
        .cta-band { background: linear-gradient(120deg, var(--navy-dk), var(--navy)); color: #fff; padding: 4rem 0; }

        /* FOOTER */
        .sph-footer { background: var(--navy-dk); color: #cdd6e8; padding: 4.5rem 0 1.5rem; }
        .sph-footer h6 { color: var(--gold); font-weight: 800; font-size: .78rem; letter-spacing: .14em; text-transform: uppercase; margin-bottom: 1.1rem; }
        .sph-footer a { color: #cdd6e8; text-decoration: none; }
        .sph-footer a:hover { color: #fff; }
        .sph-footer ul { list-style: none; padding: 0; margin: 0; }
        .sph-footer li { margin-bottom: .6rem; font-size: .92rem; }
        .sph-footer .social a { width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255,255,255,.25); display: inline-flex; align-items: center; justify-content: center; transition: all .25s; }
        .sph-footer .social a:hover { background: var(--gold); border-color: var(--gold); color: var(--ink); }

        .pagination { --bs-pagination-active-bg: var(--navy); --bs-pagination-active-border-color: var(--navy); --bs-pagination-color: var(--navy); }
    </style>
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
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.profil*') ? 'active' : '' }}" href="{{ route('public.profil') }}">Profil</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.prestasi*') ? 'active' : '' }}" href="{{ route('public.prestasi') }}">Prestasi</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.ekskul*') ? 'active' : '' }}" href="{{ route('public.ekskul') }}">Ekstrakurikuler</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.guru*') ? 'active' : '' }}" href="{{ route('public.guru') }}">Guru &amp; Staf</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.berita*') ? 'active' : '' }}" href="{{ route('public.berita') }}">Berita</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.pengumuman*') ? 'active' : '' }}" href="{{ route('public.pengumuman') }}">Pengumuman</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.galeri*') ? 'active' : '' }}" href="{{ route('public.galeri') }}">Galeri</a></li>
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
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
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
    <script>
        // Animasi hitung angka statistik
        document.querySelectorAll('[data-count]').forEach(function (el) {
            var end = parseInt(el.dataset.count) || 0;
            if (!end) return;
            el.textContent = '0';
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (!e.isIntersecting) return;
                    io.disconnect();
                    var start = null, dur = 1400;
                    function step(t) {
                        start = start || t;
                        var p = Math.min((t - start) / dur, 1);
                        el.textContent = Math.floor(end * (1 - Math.pow(1 - p, 3)));
                        if (p < 1) requestAnimationFrame(step); else el.textContent = end;
                    }
                    requestAnimationFrame(step);
                });
            }, { threshold: .4 });
            io.observe(el);
        });
    </script>
</body>
</html>

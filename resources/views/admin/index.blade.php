<!DOCTYPE html>
<html lang="en" class="material-style layout-fixed">
<head>
    <title>SMPN 1 Mangunreja</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shreerang-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}">

    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/flot/flot.css') }}">

</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Brand Logo" style="width: 50px; height: 50px; object-fit: contain;" class="img-fluid">
                    </span>
                    <a href="{{ route('admin.dashboard') }}" class="app-brand-text demo sidenav-text font-weight-normal ml-2">SMPN 1 Mangunreja</a>
                    <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        {{-- <i class="ion ion-md-menu align-middle"></i> --}}
                    </a>
                </div>
                <div class="sidenav-divider mt-0"></div>

                <!-- Links -->
                <ul class="sidenav-inner py-1">

                    <!-- Dashboards -->
                    <li class="sidenav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Dashboards</div>
                        </a>
                    </li>

                    <li class="sidenav-divider mb-1"></li>
                    <li class="sidenav-item {{ request()->routeIs('profil-sekolah.*') ? 'active' : '' }}">
                        <a href="{{ route('profil-sekolah.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-type"></i>
                            <div>Profile Sekolah</div>
                        </a>
                    </li>

                    <li class="sidenav-item {{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                        <a href="{{ route('prestasi.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-box"></i>
                            <div>Prestasi</div>
                        </a>
                    </li>

                    <li class="sidenav-divider mb-1"></li>
                    <li class="sidenav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-clipboard"></i>
                            <div>User</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                        <a href="{{ route('siswa.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-clipboard"></i>
                            <div>Data Siswa</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                        <a href="{{ route('guru.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-grid"></i>
                            <div>Data Guru</div>
                        </a>
                    </li>

                    <li class="sidenav-divider mb-1"></li>
                    <li class="sidenav-item {{ request()->routeIs('ekstrakurikuler.*') ? 'active' : '' }}">
                        <a href="{{ route('ekstrakurikuler.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-feather"></i>
                            <div>Ekstrakurikuler</div>
                        </a>
                    </li>

                    <li class="sidenav-divider mb-1"></li>
                    <li class="sidenav-item {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                        <a href="{{ route('pengumuman.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-user"></i>
                            <div>Pengumuman</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                        <a href="{{ route('berita.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-anchor"></i>
                            <div>Berita</div>
                        </a>
                    </li>
                    <li class="sidenav-item {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                        <a href="{{ route('galeri.index') }}" class="sidenav-link">
                            <i class="sidenav-icon feather icon-anchor"></i>
                            <div>Galeri</div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- [ Layout sidenav ] End -->

            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

                    <a href="{{ route('admin.dashboard') }}" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Brand Logo" style="width: 50px; height: 50px; object-fit: contain;" class="img-fluid">
                        </span>
                        <span class="app-brand-text demo font-weight-normal ml-2">Bhumlu</span>
                    </a>

                    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
                        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:">
                            <i class="ion ion-md-menu text-large align-middle"></i>
                        </a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
                        <hr class="d-lg-none w-100 my-2">
                        <div class="navbar-nav align-items-lg-center ml-auto">
                            <!-- Divider -->
                            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>
                            <div class="demo-navbar-user nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="d-block ui-w-30 rounded-circle">
                                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ Auth::user()->name ?? Auth::user()->username }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                                        <i class="feather icon-user text-muted"></i> &nbsp; My profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:" class="dropdown-item"
                                        onclick="document.getElementById('form-logout').submit()">
                                        <i class="feather icon-power text-danger"></i> &nbsp; Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- [ Layout navbar ( Header ) ] End -->

                <!-- [ Layout content ] Start -->
                <div class="layout-content">
                    @yield('contant')
                </div>
                <!-- [ Layout content ] End -->
            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper] End -->
    <form id="form-logout" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Core scripts -->
    <script src="{{ asset('assets/js/pace.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav.js') }}"></script>
    <script src="{{ asset('assets/js/layout-helpers.js') }}"></script>
    <script src="{{ asset('assets/js/material-ripple.js') }}"></script>

    <!-- Libs -->
    <script src="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/libs/eve/eve.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/flot.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/core.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/charts.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/animated.js') }}"></script>

    <!-- Demo -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="{{ asset('assets/js/pages/dashboards_index.js') }}"></script>
</body>

</html>

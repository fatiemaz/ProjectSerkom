@extends('admin.index')

@section('contant')

@php
    $isAdmin = Auth::user()->role === 'Admin';

    //  label, nilai, ikon
    $stats = [
        ['Total Siswa',          $totalSiswa,       'users',      '#7267ef', '114, 103, 239', true],
        ['Total Guru',           $totalGuru,        'user-check', '#00bcd4', '0, 188, 212',   true],
        ['Total User',           $totalUser,        'user',     '#ff5252', '255, 82, 82',   $isAdmin],
        ['Total Berita',         $totalBerita,      'file-text',  '#ff9f43', '255, 159, 67',  true],
        ['Total Pengumuman',     $totalPengumuman,  'bell',       '#28c76f', '40, 199, 111',  true],
        ['Total Prestasi',       $totalPrestasi,    'award',      '#7267ef', '114, 103, 239', true],
        ['Total Ekstrakurikuler',$totalEkskul,      'feather',    '#00bcd4', '0, 188, 212',   true],
    ];
@endphp


<div class="container-fluid flex-grow-1 container-p-y">

    {{-- CARD SAPAAN --}}
    <div class="card border-0 mb-4"
         style="background: linear-gradient(135deg, #0a2a7a 0%, #1746b8 55%, #0f3494 100%); border-radius: 12px;">
        <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
            <div>
                <h4 class="text-white font-weight-bold mb-1">
                    Selamat Datang, {{ auth()->user()->name }}! <span class="wave">👋</span>
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
            <h4 class="font-weight-bold mb-3">Dashboard</h4>
        </div>
    </div>

    {{-- KARTU STATISTIK (kecil) --}}
    <div class="row">
        @foreach ($stats as [$label, $nilai, $ikon, $warna, $rgb, $tampil])
            @if ($tampil)
                <div class="col-xl-3 col-md-4 col-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body position-relative py-3">
                            <span class="text-muted small">{{ $label }}</span>
                            <div class="d-flex align-items-center mt-1">
                                <h4 class="mb-0 font-weight-bold">{{ $nilai }}</h4>
                            </div>
                            <div class="position-absolute"
                                 style="right: 16px; top: 14px; width: 36px; height: 36px; border-radius: 8px;
                                        display: flex; align-items: center; justify-content: center;
                                        background: rgba({{ $rgb }}, 0.10);">
                                <i class="feather icon-{{ $ikon }}" style="font-size: 18px; color: {{ $warna }};"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- PENGUMUMAN TERBARU + BERITA TERBARU --}}
    <div class="row mt-2">

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

    </div> {{-- tutup row Pengumuman + Berita --}}

    {{-- GRAFIK SISWA PER TAHUN MASUK --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Siswa per Tahun Masuk</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartSiswa" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

</div> {{-- tutup container-fluid --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('chartSiswa'), {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Jumlah Siswa',
                data: @json($chartData),
                backgroundColor: '#1746b8',
                borderRadius: 6
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });
</script>

@endsection

@extends('public.template')

@section('title', $siswa->nama_siswa . ' - Data Siswa')

@section('content')

{{-- ===================== HERO HALAMAN ===================== --}}
<section class="page-hero">
    <div class="container">
        <div class="crumbs">
            <a href="{{ route('landing') }}">Beranda</a><span>/</span>
            <a href="{{ route('public.siswa') }}">Siswa</a><span>/</span>{{ $siswa->nama_siswa }}
        </div>
        <h1>{{ $siswa->nama_siswa }}</h1>
        <p>Detail data siswa</p>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="sph-card p-4 p-md-5">

                    {{-- Avatar placeholder + nama --}}
                    <div class="text-center mb-4">
                        <div class="mx-auto mb-3 overflow-hidden rounded-circle" style="width: 120px; height: 120px;">
                            <div class="thumb-ph w-100 h-100"><i class="bi bi-person-fill fs-1"></i></div>
                        </div>
                        <h4 class="fw-bold mb-2">{{ $siswa->nama_siswa }}</h4>
                        {{-- Kelas siswa (dari relasi kelas) --}}
                        @if ($siswa->kelas)
                            <span class="chip">{{ $siswa->kelas->nama_kelas }}</span>
                        @endif
                    </div>

                    {{-- Rincian data --}}
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 40%;" class="text-muted fw-normal">NISN</th>
                                {{-- NISN disamarkan demi privasi (accessor nisn_samar di model Siswa) --}}
                                <td>{{ $siswa->nisn_samar }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Nama Lengkap</th>
                                <td>{{ $siswa->nama_siswa }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Jenis Kelamin</th>
                                <td>{{ $siswa->jenis_kelamin ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Kelas</th>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Tahun Masuk</th>
                                <td>{{ $siswa->tahun_masuk ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                {{-- Tombol kembali --}}
                <div class="text-center mt-4">
                    <a href="{{ route('public.siswa') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Siswa
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

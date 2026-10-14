@extends('public.template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0 fw-bold">Biodata</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">

                        {{-- Foto Profil --}}
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                {{-- Ganti src dengan path foto kamu di folder public/images/ --}}
                                <img src="{{ asset('assets/img/fat.jpeg') }}"
                                     alt="Foto Profil"
                                     class="img-fluid rounded-circle shadow border border-4 border-white"
                                     style="width: 180px; height: 180px; object-fit: cover;">
                            </div>
                        </div>

                        {{-- Informasi Profil --}}
                        <div class="col-md-8">
                            <table class="table table-borderless fs-6">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-muted" style="width: 35%;">Nama Lengkap</td>
                                        <td style="width: 5%;">:</td>
                                        <td class="fw-bold text-dark">Fatimah Az ZAhra</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">Sekolah</td>
                                        <td>:</td>
                                        <td>SMK YPC Tasikmalaya</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">Kelas</td>
                                        <td>:</td>
                                        <td>XII (Dua Belas)</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">Jurusan</td>
                                        <td>:</td>
                                        <td>Rekayasa Perangkat Lunak (RPL)</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-muted">Alamat</td>
                                        <td>:</td>
                                        <td>kp.Kebonjati, RT/RW.001/008, des.Mangunreja, kec.Mangunreja, kab.Tasikmalaya></kab></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <a href="{{ route('landing') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

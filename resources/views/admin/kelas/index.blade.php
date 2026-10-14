@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- ===================== JUDUL ===================== --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Kelas</h4>
        </div>
    </div>

    {{-- ===================== CARD STATISTIK ===================== --}}
    <div class="row">

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Kelas</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalKelas }}</h3>
                        <span class="ml-2 text-muted">Kelas</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-home" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Siswa</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalSiswa }}</h3>
                        <span class="ml-2 text-muted">Siswa</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(40, 199, 111, 0.10);">
                        <i class="feather icon-users" style="font-size: 22px; color: #28c76f;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Rata-rata per Kelas</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $rataRata }}</h3>
                        <span class="ml-2 text-muted">Siswa</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 159, 67, 0.10);">
                        <i class="feather icon-bar-chart-2" style="font-size: 22px; color: #ff9f43;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== PENCARIAN + TAMBAH ===================== --}}
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('kelas.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control bg-transparent border-0"
                           placeholder="Cari nama kelas..." value="{{ request('search') }}"
                           style="box-shadow: none;">

                    @if (request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKelas">
                <i class="feather icon-plus mr-1"></i> TAMBAH KELAS
            </button>
        </div>
    </div>

    {{-- ===================== TABEL ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Data Kelas ({{ $totalKelas }})</h5>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="feather icon-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="feather icon-alert-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 70px;">No</th>
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($daftarKelas as $kelas)
                            <tr>
                                <td>{{ $daftarKelas->firstItem() + $loop->index }}</td>
                                <td>{{ $kelas->nama_kelas }}</td>

                                {{-- siswa_count berasal dari withCount('siswa') di controller --}}
                                <td>{{ $kelas->siswa_count }} siswa</td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button" class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit Kelas" data-toggle="modal"
                                                data-target="#modalEditKelas{{ $kelas->id_kelas }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                            @csrf
                                            @method('DELETE')

                                            {{-- Tombol dinonaktifkan jika kelas masih punya siswa --}}
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    {{ $kelas->siswa_count > 0 ? 'disabled' : '' }}
                                                    title="{{ $kelas->siswa_count > 0 ? 'Masih memiliki siswa' : 'Hapus Kelas' }}">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-layers" style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada kelas.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($daftarKelas->hasPages())
                <div class="mt-3">{{ $daftarKelas->links() }}</div>
            @endif

        </div>
    </div>

</div>

{{-- ===================== MODAL EDIT KELAS ===================== --}}
@foreach ($daftarKelas as $kelas)
    @php
        // true jika modal ini yang sedang diisi saat validasi gagal
        $isThis = old('_modal') === 'edit' && old('_kelas_id') === $kelas->id_kelas;
    @endphp

    <div class="modal fade" id="modalEditKelas{{ $kelas->id_kelas }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_kelas_id" value="{{ $kelas->id_kelas }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" name="nama_kelas" maxlength="20" placeholder="Contoh: VII A"
                                   class="form-control {{ $isThis && $errors->has('nama_kelas') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('nama_kelas') : $kelas->nama_kelas }}" required>
                            @if ($isThis)
                                @error('nama_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

{{-- ===================== MODAL TAMBAH KELAS ===================== --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahKelas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama_kelas" maxlength="20" placeholder="Contoh: VII A"
                               class="form-control {{ $isTambah && $errors->has('nama_kelas') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('nama_kelas') : '' }}" required>
                        @if ($isTambah)
                            @error('nama_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @endif
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ===================== BUKA ULANG MODAL JIKA VALIDASI GAGAL ===================== --}}
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modalType = '{{ old("_modal") }}';
            var kelasId   = '{{ old("_kelas_id") }}';

            if (modalType === 'tambah') {
                $('#modalTambahKelas').modal('show');
            } else if (modalType === 'edit' && kelasId) {
                $('#modalEditKelas' + kelasId).modal('show');
            }
        });
    </script>
@endif

@endsection

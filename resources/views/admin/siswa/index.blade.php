@extends('admin.index')

@section('contant')

@php $isAdmin = Auth::user()->role === 'Admin'; @endphp

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Siswa</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">

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
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-users" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Laki-Laki</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalLaki }}</h3>
                        <span class="ml-2 text-muted">Siswa</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(0, 188, 212, 0.10);">
                        <i class="feather icon-user" style="font-size: 22px; color: #00bcd4;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Perempuan</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalPerempuan }}</h3>
                        <span class="ml-2 text-muted">Siswa</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 82, 82, 0.10);">
                        <i class="feather icon-user" style="font-size: 22px; color: #ff5252;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('siswa.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                        class="form-control bg-transparent border-0"
                        placeholder="Cari nama atau NISN..."
                        value="{{ request('search') }}"
                        style="box-shadow: none;">

                    <select name="jenis_kelamin" class="form-control bg-transparent border-0"
                            style="max-width: 180px; box-shadow: none;"
                            onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="Laki-Laki" {{ request('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>

                    @if (request()->filled('search') || request()->filled('jenis_kelamin'))
                        <div class="input-group-append">
                            <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            @if ($isAdmin)
                <button type="button" class="btn btn-primary"
                        data-toggle="modal" data-target="#modalTambahSiswa">
                    <i class="feather icon-plus mr-1"></i>
                    TAMBAH SISWA
                </button>
            @endif
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Siswa</h5>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="feather icon-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="feather icon-alert-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tahun Masuk</th>
                            @if ($isAdmin)
                                <th class="text-center" style="width: 130px;">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($siswas as $siswa)
                            <tr>

                                <td>{{ $siswa->nomor }}</td>

                                <td>{{ $siswa->nisn ?: '-' }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>

                                <td>
                                    @if ($siswa->jenis_kelamin === 'Laki-Laki')
                                        <span class="badge badge-info">Laki-Laki</span>
                                    @elseif ($siswa->jenis_kelamin === 'Perempuan')
                                        <span class="badge badge-danger">Perempuan</span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $siswa->tahun_masuk ?: '-' }}</td>

                                {{-- AKSI (hanya Admin) --}}
                                @if ($isAdmin)
                                    <td>
                                        <div class="d-flex justify-content-center">

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary mr-2"
                                                    title="Edit Siswa"
                                                    data-toggle="modal"
                                                    data-target="#modalEditSiswa{{ $siswa->id_siswa }}">
                                                <i class="feather icon-edit-2"></i>
                                            </button>

                                            <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Hapus Siswa">
                                                    <i class="feather icon-trash-2"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 6 : 5 }}" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-users"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data siswa.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($siswas->hasPages())
                <div class="mt-3">
                    {{ $siswas->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


@if ($isAdmin)

{{-- MODAL EDIT SISWA (di luar tabel) --}}
@foreach ($siswas as $siswa)
    @php
        $isThis = old('_modal') === 'edit' && old('_siswa_id') === $siswa->id_siswa;
    @endphp

    <div class="modal fade" id="modalEditSiswa{{ $siswa->id_siswa }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_siswa_id" value="{{ $siswa->id_siswa }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" name="nisn" maxlength="10"
                                   class="form-control {{ $isThis && $errors->has('nisn') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('nisn') : $siswa->nisn }}">
                            @if ($isThis)
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama_siswa" maxlength="40"
                                   class="form-control {{ $isThis && $errors->has('nama_siswa') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('nama_siswa') : $siswa->nama_siswa }}" required>
                            @if ($isThis)
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            @php $jk = $isThis ? old('jenis_kelamin') : $siswa->jenis_kelamin; @endphp
                            <select name="jenis_kelamin"
                                    class="form-control {{ $isThis && $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-Laki" {{ $jk === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ $jk === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if ($isThis)
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tahun Masuk</label>
                            <input type="number" name="tahun_masuk" min="1900" max="{{ date('Y') }}"
                                   class="form-control {{ $isThis && $errors->has('tahun_masuk') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('tahun_masuk') : $siswa->tahun_masuk }}">
                            @if ($isThis)
                                @error('tahun_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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


{{-- MODAL TAMBAH SISWA --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" maxlength="10"
                               class="form-control {{ $isTambah && $errors->has('nisn') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('nisn') : '' }}">
                        @if ($isTambah)
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" maxlength="40"
                               class="form-control {{ $isTambah && $errors->has('nama_siswa') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('nama_siswa') : '' }}" required>
                        @if ($isTambah)
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                                class="form-control {{ $isTambah && $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-Laki" {{ $isTambah && old('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ $isTambah && old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if ($isTambah)
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" min="1900" max="{{ date('Y') }}"
                               class="form-control {{ $isTambah && $errors->has('tahun_masuk') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('tahun_masuk') : '' }}">
                        @if ($isTambah)
                            @error('tahun_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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


{{-- BUKA ULANG MODAL JIKA VALIDASI GAGAL --}}
@if ($errors->any())
    @push('scripts')
    <script>
        $(function () {
            @if (old('_modal') === 'tambah')
                $('#modalTambahSiswa').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditSiswa{{ old('_siswa_id') }}').modal('show');
            @endif
        });
    </script>
    @endpush
@endif

@endif {{-- penutup @if ($isAdmin) --}}

@endsection

@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Prestasi</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Prestasi</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalPrestasi }}</h3>
                        <span class="ml-2 text-muted">Prestasi</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-award" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('prestasi.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                           class="form-control bg-transparent border-0"
                           placeholder="Cari nama prestasi atau tahun ajaran..."
                           value="{{ request('search') }}"
                           style="box-shadow: none;">

                    @if (request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('prestasi.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif

                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#modalTambahPrestasi">
                <i class="feather icon-plus mr-1"></i>
                TAMBAH PRESTASI
            </button>
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Prestasi</h5>
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
                            <th style="width: 90px;">Foto</th>
                            <th>Nama Prestasi</th>
                            <th>Nama Siswa</th>
                            <th>Tingkat</th>
                            <th>Tahun Ajaran</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($prestasis as $prestasi)
                            <tr>

                                <td>{{ $prestasi->nomor }}</td>

                                <td>
                                    @if ($prestasi->foto)
                                        <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="Foto"
                                             style="width: 60px; height: 44px; border-radius: 6px; object-fit: cover;">
                                    @else
                                        <div style="width: 60px; height: 44px; border-radius: 6px;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-image" style="color: #7267ef; font-size: 18px;"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $prestasi->nama_prestasi }}</td>
                                <td>{{ $prestasi->nama_siswa }}</td>
                                <td><span class="badge badge-primary">{{ $prestasi->tingkat ?: '-' }}</span></td>
                                <td>{{ $prestasi->tahun_ajaran ?: '-' }}</td>
                                <td>{{ $prestasi->deskripsi ? \Illuminate\Support\Str::limit($prestasi->deskripsi, 60) : '-' }}</td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit Prestasi"
                                                data-toggle="modal"
                                                data-target="#modalEditPrestasi{{ $prestasi->id_prestasi }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        <form action="{{ route('prestasi.destroy', $prestasi->id_prestasi) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Prestasi">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-award"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data prestasi.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($prestasis->hasPages())
                <div class="mt-3">
                    {{ $prestasis->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- MODAL EDIT PRESTASI (di luar tabel) --}}
@foreach ($prestasis as $prestasi)
    @php
        $isThis = old('_modal') === 'edit' && old('_prestasi_id') === $prestasi->id_prestasi;
    @endphp

    <div class="modal fade" id="modalEditPrestasi{{ $prestasi->id_prestasi }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('prestasi.update', $prestasi->id_prestasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_prestasi_id" value="{{ $prestasi->id_prestasi }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Prestasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Prestasi</label>
                            <input type="text" name="nama_prestasi" maxlength="40"
                                   class="form-control {{ $isThis && $errors->has('nama_prestasi') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('nama_prestasi') : $prestasi->nama_prestasi }}" required>
                            @if ($isThis)
                                @error('nama_prestasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama_siswa" maxlength="40"
                                class="form-control {{ $isThis && $errors->has('nama_siswa') ? 'is-invalid' : '' }}"
                                value="{{ $isThis ? old('nama_siswa') : $prestasi->nama_siswa }}" required>
                            @if ($isThis)
                                @error('nama_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tingkat</label>
                            <select name="tingkat"
                                    class="form-control {{ $isThis && $errors->has('tingkat') ? 'is-invalid' : '' }}" required>
                                @foreach (['Sekolah','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional'] as $t)
                                    <option value="{{ $t }}"
                                        {{ ($isThis ? old('tingkat') : $prestasi->tingkat) === $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                            @if ($isThis)
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" maxlength="9"
                                   placeholder="Contoh: 2025/2026"
                                   class="form-control {{ $isThis && $errors->has('tahun_ajaran') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('tahun_ajaran') : $prestasi->tahun_ajaran }}">
                            @if ($isThis)
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                      class="form-control {{ $isThis && $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ $isThis ? old('deskripsi') : $prestasi->deskripsi }}</textarea>
                            @if ($isThis)
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            @if ($prestasi->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="Foto"
                                         style="width: 110px; height: 70px; border-radius: 8px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="foto" accept="image/*" class="form-control-file">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @if ($isThis)
                                @error('foto')
                                    <div class="text-danger small">{{ $message }}</div>
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


{{-- MODAL TAMBAH PRESTASI --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahPrestasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prestasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Prestasi</label>
                        <input type="text" name="nama_prestasi" maxlength="40"
                               class="form-control {{ $isTambah && $errors->has('nama_prestasi') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('nama_prestasi') : '' }}" required>
                        @if ($isTambah)
                            @error('nama_prestasi')
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
                        <label>Tingkat</label>
                        <select name="tingkat"
                                class="form-control {{ $isTambah && $errors->has('tingkat') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled {{ $isTambah && old('tingkat') ? '' : 'selected' }}>-- Pilih Tingkat --</option>
                            @foreach (['Sekolah','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional'] as $t)
                                <option value="{{ $t }}" {{ $isTambah && old('tingkat') === $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @if ($isTambah)
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" maxlength="9"
                               placeholder="Contoh: 2025/2026"
                               class="form-control {{ $isTambah && $errors->has('tahun_ajaran') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('tahun_ajaran') : '' }}">
                        @if ($isTambah)
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="form-control {{ $isTambah && $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ $isTambah ? old('deskripsi') : '' }}</textarea>
                        @if ($isTambah)
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" accept="image/*" class="form-control-file">
                        <small class="text-muted">Maks. 2 MB.</small>
                        @if ($isTambah)
                            @error('foto')
                                <div class="text-danger small">{{ $message }}</div>
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
    <script>
        $(function () {
            @if (old('_modal') === 'tambah')
                $('#modalTambahPrestasi').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditPrestasi{{ old('_prestasi_id') }}').modal('show');
            @endif
        });
    </script>
@endif

@endsection

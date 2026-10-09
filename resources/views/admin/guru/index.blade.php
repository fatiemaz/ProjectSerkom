@extends('admin.index')

@section('contant')

@php $isAdmin = Auth::user()->role === 'Admin'; @endphp

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Guru</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">
        @php
            $cards = [
                ['Total Guru & Staf',     $totalGuru,      'icon-users',     'Orang'],
                ['Guru Mapel',            $totalGuruMapel, 'icon-book', 'Buku'],
                ['Tenaga Kependidikan',   $totalTendik,    'icon-briefcase', 'Orang'],
            ];
        @endphp

        @foreach ($cards as [$label, $jumlah, $icon, $satuan])
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body position-relative">
                        <span class="text-muted small">{{ $label }}</span>

                        <div class="d-flex align-items-center mt-1">
                            <h3 class="mb-0 font-weight-bold">{{ $jumlah }}</h3>
                            <span class="ml-2 text-muted">{{ $satuan }}</span>
                        </div>

                        <div class="position-absolute"
                            style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                    display: flex; align-items: center; justify-content: center;
                                    background: rgba(114, 103, 239, 0.10);">
                            <i class="feather {{ $icon }}" style="font-size: 22px; color: #7267ef;"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('guru.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                        class="form-control bg-transparent border-0"
                        placeholder="Cari nama, NIP, atau mapel..."
                        value="{{ request('search') }}"
                        style="box-shadow: none;">

                    <select name="jabatan" class="form-control bg-transparent border-0"
                            style="max-width: 200px; box-shadow: none;"
                            onchange="this.form.submit()">
                        <option value="">Semua Jabatan</option>
                        @foreach (['Guru Mapel', 'Tenaga Kependidikan'] as $j)
                            <option value="{{ $j }}" {{ request('jabatan') === $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>

                    @if (request()->filled('search') || request()->filled('jabatan'))
                        <div class="input-group-append">
                            <a href="{{ route('guru.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
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
                        data-toggle="modal" data-target="#modalTambahGuru">
                    <i class="feather icon-plus mr-1"></i>
                    TAMBAH GURU
                </button>
            @endif
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Guru</h5>
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
                            <th style="width: 70px;">#</th>
                            <th style="width: 80px;">Foto</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Mapel</th>
                            @if ($isAdmin)
                                <th class="text-center" style="width: 130px;">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gurus as $guru)
                            <tr>

                                <td>{{ $guru->nomor }}</td>

                                {{-- FOTO --}}
                                <td>
                                    @if ($guru->foto)
                                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto"
                                             style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div style="width: 44px; height: 44px; border-radius: 50%;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-user" style="color: #7267ef; font-size: 18px;"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $guru->nama_guru }}</td>
                                <td>{{ $guru->nip ?: '-' }}</td>

                                <td>
                                    <span class="badge {{ $guru->jabatan === 'Guru Mapel' ? 'badge-primary' : 'badge-secondary' }}">
                                        {{ $guru->jabatan }}
                                    </span>
                                </td>

                                <td>{{ $guru->mapel ?: '-' }}</td>

                                {{-- AKSI (hanya Admin) --}}
                                @if ($isAdmin)
                                    <td>
                                        <div class="d-flex justify-content-center">

                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary mr-2"
                                                    title="Edit Guru"
                                                    data-toggle="modal"
                                                    data-target="#modalEditGuru{{ $guru->id_guru }}">
                                                <i class="feather icon-edit-2"></i>
                                            </button>

                                            <form action="{{ route('guru.destroy', $guru->id_guru) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Hapus Guru">
                                                    <i class="feather icon-trash-2"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 7 : 6 }}" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-users"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data guru.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($gurus->hasPages())
                <div class="mt-3">
                    {{ $gurus->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


@if ($isAdmin)

{{-- MODAL EDIT GURU (di luar tabel) --}}
@foreach ($gurus as $guru)
    <div class="modal fade" id="modalEditGuru{{ $guru->id_guru }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_guru_id" value="{{ $guru->id_guru }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="nama_guru" maxlength="40"
                                   class="form-control {{ old('_guru_id') === $guru->id_guru && $errors->has('nama_guru') ? 'is-invalid' : '' }}"
                                   value="{{ old('_guru_id') === $guru->id_guru ? old('nama_guru') : $guru->nama_guru }}" required>
                            @if (old('_guru_id') === $guru->id_guru)
                                @error('nama_guru')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" maxlength="15"
                                   class="form-control {{ old('_guru_id') === $guru->id_guru && $errors->has('nip') ? 'is-invalid' : '' }}"
                                   value="{{ old('_guru_id') === $guru->id_guru ? old('nip') : $guru->nip }}">
                            @if (old('_guru_id') === $guru->id_guru)
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            @php
                                $jabatanDipilih = old('_guru_id') === $guru->id_guru ? old('jabatan') : $guru->jabatan;
                            @endphp
                            <select name="jabatan"
                                    class="form-control select-jabatan {{ old('_guru_id') === $guru->id_guru && $errors->has('jabatan') ? 'is-invalid' : '' }}" required>
                                @foreach (['Guru Mapel', 'Tenaga Kependidikan'] as $j)
                                    <option value="{{ $j }}" {{ $jabatanDipilih === $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            @if (old('_guru_id') === $guru->id_guru)
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group wrap-mapel">
                            <label>Mata Pelajaran</label>
                            <input type="text" name="mapel" maxlength="40"
                                   class="form-control {{ old('_guru_id') === $guru->id_guru && $errors->has('mapel') ? 'is-invalid' : '' }}"
                                   value="{{ old('_guru_id') === $guru->id_guru ? old('mapel') : $guru->mapel }}">
                            @if (old('_guru_id') === $guru->id_guru)
                                @error('mapel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            @if ($guru->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto"
                                         style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="foto" accept="image/*" class="form-control-file">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @if (old('_guru_id') === $guru->id_guru)
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


{{-- MODAL TAMBAH GURU --}}
<div class="modal fade" id="modalTambahGuru" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" maxlength="40"
                               class="form-control {{ old('_modal') === 'tambah' && $errors->has('nama_guru') ? 'is-invalid' : '' }}"
                               value="{{ old('_modal') === 'tambah' ? old('nama_guru') : '' }}" required>
                        @if (old('_modal') === 'tambah')
                            @error('nama_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" maxlength="15"
                               class="form-control {{ old('_modal') === 'tambah' && $errors->has('nip') ? 'is-invalid' : '' }}"
                               value="{{ old('_modal') === 'tambah' ? old('nip') : '' }}">
                        @if (old('_modal') === 'tambah')
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan"
                                class="form-control select-jabatan {{ old('_modal') === 'tambah' && $errors->has('jabatan') ? 'is-invalid' : '' }}" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach (['Guru Mapel', 'Tenaga Kependidikan'] as $j)
                                <option value="{{ $j }}"
                                    {{ old('_modal') === 'tambah' && old('jabatan') === $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        @if (old('_modal') === 'tambah')
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group wrap-mapel">
                        <label>Mata Pelajaran</label>
                        <input type="text" name="mapel" maxlength="40"
                               class="form-control {{ old('_modal') === 'tambah' && $errors->has('mapel') ? 'is-invalid' : '' }}"
                               value="{{ old('_modal') === 'tambah' ? old('mapel') : '' }}">
                        @if (old('_modal') === 'tambah')
                            @error('mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" accept="image/*" class="form-control-file">
                        <small class="text-muted">Maks. 2 MB.</small>
                        @if (old('_modal') === 'tambah')
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
        @push('scripts')
        <script>
            $(function () {
                @if (old('_modal') === 'tambah')
                    $('#modalTambahGuru').modal('show');
                @elseif (old('_modal') === 'edit')
                    $('#modalEditGuru{{ old('_guru_id') }}').modal('show');
                @endif
            });
        </script>
        @endpush
    @endif

    {{-- TOGGLE MAPEL --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function toggleMapel(select) {
                var isTendik = select.value === 'Tenaga Kependidikan';
                var wrap = select.closest('form').querySelector('.wrap-mapel');
                if (!wrap) return;

                wrap.style.display = isTendik ? 'none' : '';
                wrap.querySelectorAll('input').forEach(function (input) {
                    input.disabled = isTendik;
                });
            }

            document.querySelectorAll('.select-jabatan').forEach(function (select) {
                toggleMapel(select);
                select.addEventListener('change', function () {
                    toggleMapel(select);
                });
            });
        });
    </script>
    @endpush

    @endif {{-- penutup @if ($isAdmin) --}}

@endsection

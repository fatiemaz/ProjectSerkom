@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Ekstrakurikuler</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Ekstrakurikuler</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalEkskul }}</h3>
                        <span class="ml-2 text-muted">Ekskul</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-feather" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('ekstrakurikuler.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                           class="form-control bg-transparent border-0"
                           placeholder="Cari nama ekskul atau pembina..."
                           value="{{ request('search') }}"
                           style="box-shadow: none;">

                    @if (request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif

                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#modalTambahEkskul">
                <i class="feather icon-plus mr-1"></i>
                TAMBAH EKSKUL
            </button>
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Ekstrakurikuler</h5>
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
                            <th style="width: 90px;">Gambar</th>
                            <th>Nama Ekskul</th>
                            <th>Pembina</th>
                            <th>Jadwal Latihan</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($ekskuls as $ekskul)
                            <tr>

                                <td>
                                    {{ $loop->iteration + (($ekskuls->currentPage() - 1) * $ekskuls->perPage()) }}
                                </td>

                                <td>
                                    @if ($ekskul->gambar)
                                        <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="Gambar"
                                             style="width: 60px; height: 44px; border-radius: 6px; object-fit: cover;">
                                    @else
                                        <div style="width: 60px; height: 44px; border-radius: 6px;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-image" style="color: #7267ef; font-size: 18px;"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $ekskul->nama_ekskul }}</td>
                                <td>{{ $ekskul->pembina ?: '-' }}</td>
                                <td>{{ $ekskul->jadwal_latihan ?: '-' }}</td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit Ekskul"
                                                data-toggle="modal"
                                                data-target="#modalEditEkskul{{ $ekskul->id_ekskul }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        <form action="{{ route('ekstrakurikuler.destroy', $ekskul->id_ekskul) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Ekskul">
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
                                        <i class="feather icon-feather"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data ekstrakurikuler.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($ekskuls->hasPages())
                <div class="mt-3">
                    {{ $ekskuls->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- MODAL EDIT EKSKUL (di luar tabel) --}}
@foreach ($ekskuls as $ekskul)
    @php
        $isThis = old('_modal') === 'edit' && old('_ekskul_id') === $ekskul->id_ekskul;
    @endphp

    <div class="modal fade" id="modalEditEkskul{{ $ekskul->id_ekskul }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('ekstrakurikuler.update', $ekskul->id_ekskul) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_ekskul_id" value="{{ $ekskul->id_ekskul }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Ekstrakurikuler</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Ekskul</label>
                            <input type="text" name="nama_ekskul" maxlength="40"
                                   class="form-control {{ $isThis && $errors->has('nama_ekskul') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('nama_ekskul') : $ekskul->nama_ekskul }}" required>
                            @if ($isThis)
                                @error('nama_ekskul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Pembina</label>
                            <input type="text" name="pembina" maxlength="40"
                                   class="form-control {{ $isThis && $errors->has('pembina') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('pembina') : $ekskul->pembina }}">
                            @if ($isThis)
                                @error('pembina')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jadwal Latihan</label>
                            <input type="text" name="jadwal_latihan" maxlength="40"
                                   placeholder="Contoh: Sabtu, 14.00 - 16.00"
                                   class="form-control {{ $isThis && $errors->has('jadwal_latihan') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('jadwal_latihan') : $ekskul->jadwal_latihan }}">
                            @if ($isThis)
                                @error('jadwal_latihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                      class="form-control {{ $isThis && $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ $isThis ? old('deskripsi') : $ekskul->deskripsi }}</textarea>
                            @if ($isThis)
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            @if ($ekskul->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="Gambar"
                                         style="width: 110px; height: 70px; border-radius: 8px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="gambar" accept="image/*" class="form-control-file">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @if ($isThis)
                                @error('gambar')
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


{{-- MODAL TAMBAH EKSKUL --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahEkskul" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ekstrakurikuler</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Ekskul</label>
                        <input type="text" name="nama_ekskul" maxlength="40"
                               class="form-control {{ $isTambah && $errors->has('nama_ekskul') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('nama_ekskul') : '' }}" required>
                        @if ($isTambah)
                            @error('nama_ekskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Pembina</label>
                        <input type="text" name="pembina" maxlength="40"
                               class="form-control {{ $isTambah && $errors->has('pembina') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('pembina') : '' }}">
                        @if ($isTambah)
                            @error('pembina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Jadwal Latihan</label>
                        <input type="text" name="jadwal_latihan" maxlength="40"
                               placeholder="Contoh: Sabtu, 14.00 - 16.00"
                               class="form-control {{ $isTambah && $errors->has('jadwal_latihan') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('jadwal_latihan') : '' }}">
                        @if ($isTambah)
                            @error('jadwal_latihan')
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
                        <label>Gambar</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control-file">
                        <small class="text-muted">Maks. 2 MB.</small>
                        @if ($isTambah)
                            @error('gambar')
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
                $('#modalTambahEkskul').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditEkskul{{ old('_ekskul_id') }}').modal('show');
            @endif
        });
    </script>
@endif

@endsection

@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Berita</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Berita</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalBerita }}</h3>
                        <span class="ml-2 text-muted">Berita</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-file-text" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Publish</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalPublish }}</h3>
                        <span class="ml-2 text-muted">Berita</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(40, 199, 111, 0.10);">
                        <i class="feather icon-check-circle" style="font-size: 22px; color: #28c76f;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Draft</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalDraft }}</h3>
                        <span class="ml-2 text-muted">Berita</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 159, 67, 0.10);">
                        <i class="feather icon-edit" style="font-size: 22px; color: #ff9f43;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('berita.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                           class="form-control bg-transparent border-0"
                           placeholder="Cari judul berita..."
                           value="{{ request('search') }}"
                           style="box-shadow: none;">

                    @if (request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif

                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#modalTambahBerita">
                <i class="feather icon-plus mr-1"></i>
                TAMBAH BERITA
            </button>
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Berita</h5>
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
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Penulis</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($beritas as $berita)
                            <tr>

                                <td>
                                    {{ $loop->iteration + (($beritas->currentPage() - 1) * $beritas->perPage()) }}
                                </td>

                                <td>
                                    @if ($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar"
                                             style="width: 60px; height: 44px; border-radius: 6px; object-fit: cover;">
                                    @else
                                        <div style="width: 60px; height: 44px; border-radius: 6px;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-image" style="color: #7267ef; font-size: 18px;"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div>{{ $berita->judul }}</div>
                                    @if ($berita->isi)
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($berita->isi, 60) }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d/m/Y') : '-' }}
                                </td>

                                <td>
                                    @if ($berita->status === 'Publish')
                                        <span class="badge badge-success">Publish</span>
                                    @else
                                        <span class="badge badge-warning">Draft</span>
                                    @endif
                                </td>

                                <td>{{ $berita->user->name ?? $berita->user->username ?? '-' }}</td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit Berita"
                                                data-toggle="modal"
                                                data-target="#modalEditBerita{{ $berita->id_berita }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        <form action="{{ route('berita.destroy', $berita->id_berita) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Berita">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-file-text"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada berita.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($beritas->hasPages())
                <div class="mt-3">
                    {{ $beritas->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- MODAL EDIT BERITA (di luar tabel) --}}
@foreach ($beritas as $berita)
    @php
        $isThis = old('_modal') === 'edit' && old('_berita_id') === $berita->id_berita;
        $tgl    = $isThis
                    ? old('tanggal')
                    : ($berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : '');
        $stat   = $isThis ? old('status') : $berita->status;
    @endphp

    <div class="modal fade" id="modalEditBerita{{ $berita->id_berita }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_berita_id" value="{{ $berita->id_berita }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" maxlength="50"
                                   class="form-control {{ $isThis && $errors->has('judul') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('judul') : $berita->judul }}" required>
                            @if ($isThis)
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal"
                                       class="form-control {{ $isThis && $errors->has('tanggal') ? 'is-invalid' : '' }}"
                                       value="{{ $tgl }}">
                                @if ($isThis)
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status"
                                        class="form-control {{ $isThis && $errors->has('status') ? 'is-invalid' : '' }}" required>
                                    <option value="Draft" {{ $stat === 'Draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="Publish" {{ $stat === 'Publish' ? 'selected' : '' }}>Publish</option>
                                </select>
                                @if ($isThis)
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" rows="5"
                                      class="form-control {{ $isThis && $errors->has('isi') ? 'is-invalid' : '' }}">{{ $isThis ? old('isi') : $berita->isi }}</textarea>
                            @if ($isThis)
                                @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            @if ($berita->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar"
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


{{-- MODAL TAMBAH BERITA --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahBerita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" maxlength="50"
                               class="form-control {{ $isTambah && $errors->has('judul') ? 'is-invalid' : '' }}"
                               value="{{ $isTambah ? old('judul') : '' }}" required>
                        @if ($isTambah)
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal"
                                   class="form-control {{ $isTambah && $errors->has('tanggal') ? 'is-invalid' : '' }}"
                                   value="{{ $isTambah ? old('tanggal') : date('Y-m-d') }}">
                            @if ($isTambah)
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status"
                                    class="form-control {{ $isTambah && $errors->has('status') ? 'is-invalid' : '' }}" required>
                                <option value="Draft" {{ $isTambah && old('status') === 'Publish' ? '' : 'selected' }}>Draft</option>
                                <option value="Publish" {{ $isTambah && old('status') === 'Publish' ? 'selected' : '' }}>Publish</option>
                            </select>
                            @if ($isTambah)
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Isi</label>
                        <textarea name="isi" rows="5"
                                  class="form-control {{ $isTambah && $errors->has('isi') ? 'is-invalid' : '' }}">{{ $isTambah ? old('isi') : '' }}</textarea>
                        @if ($isTambah)
                            @error('isi')
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
                $('#modalTambahBerita').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditBerita{{ old('_berita_id') }}').modal('show');
            @endif
        });
    </script>
@endif

@endsection

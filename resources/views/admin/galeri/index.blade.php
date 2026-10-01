@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data Galeri</h4>
        </div>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total Galeri</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalGaleri }}</h3>
                        <span class="ml-2 text-muted">Item</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(114, 103, 239, 0.10);">
                        <i class="feather icon-image" style="font-size: 22px; color: #7267ef;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Foto</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalFoto }}</h3>
                        <span class="ml-2 text-muted">Item</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(0, 188, 212, 0.10);">
                        <i class="feather icon-camera" style="font-size: 22px; color: #00bcd4;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Video</span>
                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalVideo }}</h3>
                        <span class="ml-2 text-muted">Item</span>
                    </div>
                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 82, 82, 0.10);">
                        <i class="feather icon-video" style="font-size: 22px; color: #ff5252;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SEARCH + TAMBAH --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <form action="{{ route('galeri.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>
                    <input type="text" name="search"
                           class="form-control bg-transparent border-0"
                           placeholder="Cari judul galeri..."
                           value="{{ request('search') }}"
                           style="box-shadow: none;">

                    @if (request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('galeri.index') }}" class="btn btn-sm btn-outline-secondary align-self-center">
                                <i class="feather icon-x"></i> Reset
                            </a>
                        </div>
                    @endif

                </div>
            </form>
        </div>

        <div class="col-md-4 text-right">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#modalTambahGaleri">
                <i class="feather icon-plus mr-1"></i>
                TAMBAH GALERI
            </button>
        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data Galeri</h5>
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
                            <th style="width: 100px;">Preview</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($galeris as $galeri)
                            <tr>

                                <td>{{ $galeri->nomor }}</td>

                                {{-- PREVIEW --}}
                                <td>
                                    @if ($galeri->file && $galeri->kategori === 'Foto')
                                        <img src="{{ asset('storage/' . $galeri->file) }}" alt="Foto"
                                             style="width: 70px; height: 48px; border-radius: 6px; object-fit: cover;">
                                    @elseif ($galeri->file && $galeri->kategori === 'Video')
                                        <video src="{{ asset('storage/' . $galeri->file) }}" muted preload="metadata"
                                               style="width: 70px; height: 48px; border-radius: 6px; object-fit: cover;"></video>
                                    @else
                                        <div style="width: 70px; height: 48px; border-radius: 6px;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-image" style="color: #7267ef; font-size: 18px;"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div>{{ $galeri->judul }}</div>
                                    @if ($galeri->keterangan)
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($galeri->keterangan, 60) }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    @if ($galeri->kategori === 'Foto')
                                        <span class="badge badge-info">Foto</span>
                                    @elseif ($galeri->kategori === 'Video')
                                        <span class="badge badge-danger">Video</span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    {{ $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('d/m/Y') : '-' }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit Galeri"
                                                data-toggle="modal"
                                                data-target="#modalEditGaleri{{ $galeri->id_galeri }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus item galeri ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Galeri">
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
                                        <i class="feather icon-image"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data galeri.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($galeris->hasPages())
                <div class="mt-3">
                    {{ $galeris->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- MODAL EDIT GALERI (di luar tabel) --}}
@foreach ($galeris as $galeri)
    @php
        $isThis = old('_modal') === 'edit' && old('_galeri_id') === $galeri->id_galeri;
        $tgl    = $isThis
                    ? old('tanggal')
                    : ($galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('Y-m-d') : '');
        $kat    = $isThis ? old('kategori') : $galeri->kategori;
    @endphp

    <div class="modal fade" id="modalEditGaleri{{ $galeri->id_galeri }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_galeri_id" value="{{ $galeri->id_galeri }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Galeri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" maxlength="50"
                                   class="form-control {{ $isThis && $errors->has('judul') ? 'is-invalid' : '' }}"
                                   value="{{ $isThis ? old('judul') : $galeri->judul }}" required>
                            @if ($isThis)
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Kategori</label>
                                <select name="kategori"
                                        class="form-control {{ $isThis && $errors->has('kategori') ? 'is-invalid' : '' }}" required>
                                    <option value="Foto" {{ $kat === 'Foto' ? 'selected' : '' }}>Foto</option>
                                    <option value="Video" {{ $kat === 'Video' ? 'selected' : '' }}>Video</option>
                                </select>
                                @if ($isThis)
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

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
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" rows="3"
                                      class="form-control {{ $isThis && $errors->has('keterangan') ? 'is-invalid' : '' }}">{{ $isThis ? old('keterangan') : $galeri->keterangan }}</textarea>
                            @if ($isThis)
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-group">
                            <label>File</label>
                            @if ($galeri->file)
                                <div class="mb-2">
                                    @if ($galeri->kategori === 'Video')
                                        <video src="{{ asset('storage/' . $galeri->file) }}" controls preload="metadata"
                                               style="width: 100%; max-height: 200px; border-radius: 8px;"></video>
                                    @else
                                        <img src="{{ asset('storage/' . $galeri->file) }}" alt="Foto"
                                             style="width: 110px; height: 70px; border-radius: 8px; object-fit: cover;">
                                    @endif
                                </div>
                            @endif
                            <input type="file" name="file" accept="image/*,video/mp4,video/webm,video/quicktime"
                                   class="form-control-file">
                            <small class="text-muted">Foto maks. 2 MB, video (mp4/webm/mov) maks. 20 MB. Kosongkan jika tidak diganti.</small>
                            @if ($isThis)
                                @error('file')
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


{{-- MODAL TAMBAH GALERI --}}
@php $isTambah = old('_modal') === 'tambah'; @endphp

<div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Galeri</h5>
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
                            <label>Kategori</label>
                            <select name="kategori"
                                    class="form-control {{ $isTambah && $errors->has('kategori') ? 'is-invalid' : '' }}" required>
                                <option value="Foto" {{ $isTambah && old('kategori') === 'Video' ? '' : 'selected' }}>Foto</option>
                                <option value="Video" {{ $isTambah && old('kategori') === 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @if ($isTambah)
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

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
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="3"
                                  class="form-control {{ $isTambah && $errors->has('keterangan') ? 'is-invalid' : '' }}">{{ $isTambah ? old('keterangan') : '' }}</textarea>
                        @if ($isTambah)
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    <div class="form-group">
                        <label>File</label>
                        <input type="file" name="file" accept="image/*,video/mp4,video/webm,video/quicktime"
                               class="form-control-file" required>
                        <small class="text-muted">Foto maks. 2 MB, video (mp4/webm/mov) maks. 20 MB.</small>
                        @if ($isTambah)
                            @error('file')
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
                $('#modalTambahGaleri').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditGaleri{{ old('_galeri_id') }}').modal('show');
            @endif
        });
    </script>
@endif

@endsection

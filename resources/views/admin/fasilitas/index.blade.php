@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">Data Fasilitas</h4>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahFasilitas">
            <i class="feather icon-plus mr-1"></i> TAMBAH FASILITAS
        </button>
    </div>

    <div class="card">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 90px;">Foto</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fasilitas as $f)
                            <tr>
                                <td>{{ $fasilitas->firstItem() + $loop->index }}</td>
                                <td>
                                    @if ($f->foto)
                                        <img src="{{ asset('storage/' . $f->foto) }}" alt=""
                                             style="width: 60px; height: 44px; border-radius: 6px; object-fit: cover;">
                                    @else
                                        <i class="feather icon-image text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $f->nama }}</td>
                                <td>{{ $f->deskripsi ?: '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary mr-2"
                                                data-toggle="modal" data-target="#modalEditFasilitas{{ $f->id_fasilitas }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>
                                        <form action="{{ route('fasilitas.destroy', $f->id_fasilitas) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-5">Belum ada data fasilitas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($fasilitas->hasPages())
                <div class="mt-3">{{ $fasilitas->links() }}</div>
            @endif
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach ($fasilitas as $f)
    <div class="modal fade" id="modalEditFasilitas{{ $f->id_fasilitas }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('fasilitas.update', $f->id_fasilitas) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Fasilitas</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" maxlength="40" class="form-control" value="{{ $f->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="3" maxlength="150" class="form-control">{{ $f->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            @if ($f->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $f->foto) }}" alt=""
                                         style="width: 110px; height: 70px; border-radius: 8px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="foto" accept="image/*" class="form-control-file">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
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

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahFasilitas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fasilitas</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" maxlength="40" class="form-control" value="{{ old('nama') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3" maxlength="150" class="form-control">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" accept="image/*" class="form-control-file">
                        <small class="text-muted">Maks. 2 MB.</small>
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

@endsection

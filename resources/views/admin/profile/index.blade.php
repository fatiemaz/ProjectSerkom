@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL + TOMBOL EDIT --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">Profile Sekolah</h4>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditProfile">
            <i class="feather icon-edit-2 mr-1"></i>
            {{ $profile ? 'EDIT PROFIL' : 'ISI PROFIL' }}
        </button>
    </div>

    {{-- PESAN SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <i class="feather icon-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (!$profile)

        <div class="card">
            <div class="card-body text-center py-5">
                <i class="feather icon-home" style="font-size: 40px; color: #c8c8c8;"></i>
                <div class="text-muted mt-2">Profil sekolah belum diisi.</div>
            </div>
        </div>

    @else

        {{-- HEADER PROFIL --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap">

                    @if ($profile->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo"
                             style="width: 90px; height: 90px; object-fit: contain;" class="mr-4">
                    @else
                        <div class="mr-4 d-flex align-items-center justify-content-center"
                             style="width: 90px; height: 90px; border-radius: 12px; background: rgba(114, 103, 239, 0.10);">
                            <i class="feather icon-home" style="font-size: 36px; color: #7267ef;"></i>
                        </div>
                    @endif

                    <div>
                        <h3 class="font-weight-bold mb-1">{{ $profile->nama_sekolah }}</h3>
                        <div class="text-muted">
                            Kepala Sekolah: <strong>{{ $profile->kepala_sekolah }}</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            {{-- KOLOM KIRI: INFORMASI UMUM --}}
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header"><h5 class="mb-0">Informasi Umum</h5></div>
                    <div class="card-body">

                        @if ($profile->foto)
                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Sekolah"
                                 class="img-fluid rounded mb-4">
                        @endif

                        <div class="mb-3">
                            <div class="text-muted small">NPSN</div>
                            <div>{{ $profile->npsn ?: '-' }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Tahun Berdiri</div>
                            <div>{{ $profile->tahun_berdiri ?: '-' }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Kontak</div>
                            <div>{{ $profile->kontak ?: '-' }}</div>
                        </div>

                        <div>
                            <div class="text-muted small">Alamat</div>
                            <div>{!! $profile->alamat ? nl2br(e($profile->alamat)) : '-' !!}</div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DESKRIPSI, VISI, MISI --}}
            <div class="col-lg-8 mb-4">

                <div class="card mb-4">
                    <div class="card-header"><h5 class="mb-0">Deskripsi</h5></div>
                    <div class="card-body">
                        {!! $profile->deskripsi ? nl2br(e($profile->deskripsi)) : '<span class="text-muted">Belum diisi.</span>' !!}
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header"><h5 class="mb-0">Visi</h5></div>
                    <div class="card-body">
                        {!! $profile->visi ? nl2br(e($profile->visi)) : '<span class="text-muted">Belum diisi.</span>' !!}
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Misi</h5></div>
                    <div class="card-body">
                        {!! $profile->misi ? nl2br(e($profile->misi)) : '<span class="text-muted">Belum diisi.</span>' !!}
                    </div>
                </div>

            </div>

        </div>

    @endif

</div>


{{-- MODAL EDIT PROFIL --}}
<div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="{{ route('profil-sekolah.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">{{ $profile ? 'Edit Profil Sekolah' : 'Isi Profil Sekolah' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" maxlength="40"
                                   class="form-control @error('nama_sekolah') is-invalid @enderror"
                                   value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}" required>
                            @error('nama_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>Kepala Sekolah</label>
                            <input type="text" name="kepala_sekolah" maxlength="40"
                                   class="form-control @error('kepala_sekolah') is-invalid @enderror"
                                   value="{{ old('kepala_sekolah', $profile->kepala_sekolah ?? '') }}" required>
                            @error('kepala_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>NPSN</label>
                            <input type="text" name="npsn" maxlength="10"
                                   class="form-control @error('npsn') is-invalid @enderror"
                                   value="{{ old('npsn', $profile->npsn ?? '') }}">
                            @error('npsn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" min="1900" max="{{ date('Y') }}"
                                   class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                   value="{{ old('tahun_berdiri', $profile->tahun_berdiri ?? '') }}">
                            @error('tahun_berdiri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>Kontak</label>
                            <input type="text" name="kontak" maxlength="15"
                                   class="form-control @error('kontak') is-invalid @enderror"
                                   value="{{ old('kontak', $profile->kontak ?? '') }}">
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="2"
                                  class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Visi</label>
                        <textarea name="visi" rows="3"
                                  class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profile->visi ?? '') }}</textarea>
                        @error('visi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Misi</label>
                        <textarea name="misi" rows="4"
                                  class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $profile->misi ?? '') }}</textarea>
                        @error('misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Logo</label>
                            <input type="file" name="logo" accept="image/*"
                                   class="form-control-file @error('logo') is-invalid @enderror">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @error('logo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label>Foto Sekolah</label>
                            <input type="file" name="foto" accept="image/*"
                                   class="form-control-file @error('foto') is-invalid @enderror">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @error('foto')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Video (MP4)</label>

                            @if (!empty($profile->video))
                                <video src="{{ asset('storage/' . $profile->video) }}" muted controls
                                    style="width: 220px; border-radius: 8px;" class="d-block mb-2"></video>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="hapus_video" name="hapus_video" value="1">
                                    <label class="custom-control-label" for="hapus_video">Hapus video ini</label>
                                </div>
                            @endif

                            <input type="file" name="video" accept="video/mp4" class="form-control-file">
                            <small class="text-muted">MP4, maks. 20 MB, sebaiknya 10-20 detik. Kosongkan jika tidak diganti.</small>
                            @error('video')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
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
            $('#modalEditProfile').modal('show');
        });
    </script>
@endif

@endsection

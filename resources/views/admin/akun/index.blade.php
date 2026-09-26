@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold mb-4">Profile</h4>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <i class="feather icon-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="card mb-4">
        <div class="card-body d-flex align-items-center">

            @if ($profil && $profil->foto)
                <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto"
                     class="mr-4" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
            @else
                <div class="mr-4 d-flex align-items-center justify-content-center"
                     style="width: 80px; height: 80px; border-radius: 50%; background: rgba(114, 103, 239, 0.10);">
                    <i class="feather icon-user" style="font-size: 34px; color: #7267ef;"></i>
                </div>
            @endif

            <div>
                <h4 class="font-weight-bold mb-1">{{ $profil->nama_lengkap ?? $user->name }}</h4>
                <div class="text-muted mb-1">
                    {{ '@' . $user->username }}
                    @if ($profil && $profil->jabatan) &middot; {{ $profil->jabatan }} @endif
                </div>
                @if ($user->role === 'Admin')
                    <span class="badge badge-danger">Admin</span>
                @else
                    <span class="badge badge-secondary">{{ $user->role }}</span>
                @endif
            </div>

        </div>
    </div>

    <div class="row">

        {{-- DATA PROFIL --}}
        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Data Profil</h5></div>
                <div class="card-body">

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" maxlength="40"
                                       class="form-control @error('nama_lengkap') is-invalid @enderror"
                                       value="{{ old('nama_lengkap', $profil->nama_lengkap ?? $user->name) }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" maxlength="30"
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" maxlength="40"
                                       class="form-control @error('jabatan') is-invalid @enderror"
                                       value="{{ old('jabatan', $profil->jabatan ?? '') }}">
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>No. HP</label>
                                <input type="text" name="no_hp" maxlength="15"
                                       class="form-control @error('no_hp') is-invalid @enderror"
                                       value="{{ old('no_hp', $profil->no_hp ?? '') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="2"
                                      class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" accept="image/*" class="form-control-file">
                            <small class="text-muted">Maks. 2 MB. Kosongkan jika tidak diganti.</small>
                            @error('foto')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>

        {{-- GANTI PASSWORD --}}
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header"><h5 class="mb-0">Ganti Password</h5></div>
                <div class="card-body">

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" name="password_lama"
                                   class="form-control @error('password_lama') is-invalid @enderror" required>
                            @error('password_lama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection

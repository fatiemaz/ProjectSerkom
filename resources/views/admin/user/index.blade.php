@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    {{-- JUDUL HALAMAN --}}
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Data User</h4>
        </div>
    </div>


    {{-- CARD STATISTIK --}}
    <div class="row">

        {{-- TOTAL USER --}}
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Total User</span>

                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalUser }}</h3>
                        <span class="ml-2 text-muted">User</span>
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

        {{-- TOTAL ADMIN --}}
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Jumlah Admin</span>

                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalAdmin }}</h3>
                        <span class="ml-2 text-muted">User</span>
                    </div>

                    <div class="position-absolute"
                         style="right: 20px; top: 22px; width: 42px; height: 42px; border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                background: rgba(255, 82, 82, 0.10);">
                        <i class="feather icon-shield" style="font-size: 22px; color: #ff5252;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL OPERATOR --}}
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body position-relative">
                    <span class="text-muted small">Jumlah Operator</span>

                    <div class="d-flex align-items-center mt-1">
                        <h3 class="mb-0 font-weight-bold">{{ $totalOperator }}</h3>
                        <span class="ml-2 text-muted">User</span>
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

    </div>


    {{-- SEARCH + TAMBAH USER --}}
    <div class="row align-items-center mb-4">

        {{-- SEARCH --}}
        <div class="col-md-8">
            <form action="{{ route('user.index') }}" method="GET">
                <div class="input-group" style="border-bottom: 1px solid #e3e6ef;">

                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pl-0">
                            <i class="feather icon-search" style="font-size: 18px;"></i>
                        </span>
                    </div>

                    <input type="text"
                           name="search"
                           class="form-control bg-transparent border-0"
                           placeholder="Cari username..."
                           value="{{ request('search') }}"
                           style="box-shadow: none;">

                </div>
            </form>
        </div>

        {{-- TOMBOL TAMBAH --}}
        <div class="col-md-4 text-right">
            <button type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#modalTambahUser">
                <i class="feather icon-plus mr-1"></i>
                TAMBAH USER
            </button>
        </div>

    </div>


    {{-- CARD TABEL --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Data User</h5>
        </div>

        <div class="card-body">

            {{-- PESAN SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <i class="feather icon-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <i class="feather icon-alert-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif


            {{-- TABEL --}}
            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th style="width: 70px;">#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($users as $user)

                            <tr>

                                {{-- NOMOR --}}
                                <td>
                                    {{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}
                                </td>

                                {{-- NAMA --}}
                                <td>{{ $user->name }}</td>

                                {{-- USERNAME --}}
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="mr-2"
                                             style="width: 32px; height: 32px; border-radius: 50%;
                                                    background: rgba(114, 103, 239, 0.10);
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="feather icon-user"
                                               style="color: #7267ef; font-size: 16px;"></i>
                                        </div>

                                        <span>{{ $user->username }}</span>

                                    </div>
                                </td>

                                {{-- ROLE --}}
                                <td>
                                    @if ($user->role === 'Admin')
                                        <span class="badge badge-danger">Admin</span>
                                    @elseif ($user->role === 'Operator')
                                        <span class="badge badge-secondary">Operator</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="d-flex justify-content-center">

                                        {{-- EDIT (BUKA MODAL) --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary mr-2"
                                                title="Edit User"
                                                data-toggle="modal"
                                                data-target="#modalEditUser{{ $user->id_user }}">
                                            <i class="feather icon-edit-2"></i>
                                        </button>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('user.destroy', $user->id_user) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus User">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-2">
                                        <i class="feather icon-users"
                                           style="font-size: 40px; color: #c8c8c8;"></i>
                                    </div>
                                    <span class="text-muted">Belum ada data user.</span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if ($users->hasPages())
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @endif

        </div>

    </div>

</div>


{{-- MODAL EDIT USER (di luar tabel) --}}
@foreach ($users as $user)
    <div class="modal fade" id="modalEditUser{{ $user->id_user }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="{{ route('user.update', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_modal" value="edit">
                    <input type="hidden" name="_user_id" value="{{ $user->id_user }}">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" maxlength="100"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" maxlength="30"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Kosongkan jika tidak ingin mengubah password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Operator" {{ old('role', $user->role) === 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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


{{-- MODAL TAMBAH USER --}}
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_modal" value="tambah">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" maxlength="100"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" maxlength="30"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Role --</option>
                            <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Operator" {{ old('role') === 'Operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                $('#modalTambahUser').modal('show');
            @elseif (old('_modal') === 'edit')
                $('#modalEditUser{{ old('_user_id') }}').modal('show');
            @endif
        });
    </script>
@endif

@endsection

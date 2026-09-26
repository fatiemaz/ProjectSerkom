@extends('admin.index')

@section('contant')

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4">Edit User</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Data User</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('user.update', ['user' => $user->id_users]) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username', $user->username) }}"
                        maxlength="30"
                        required
                    >

                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>

                    <select
                        name="role"
                        id="role"
                        class="form-control @error('role') is-invalid @enderror"
                        required
                    >
                        <option value="Admin"
                            {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Operator"
                            {{ old('role', $user->role) === 'Operator' ? 'selected' : '' }}>
                            Operator
                        </option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="feather icon-save mr-1"></i>
                        UPDATE
                    </button>

                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        BATAL
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

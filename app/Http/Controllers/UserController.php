<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user (create & edit pakai modal di halaman ini)
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('nomor')
            ->paginate(10)
            ->withQueryString();

        $totalUser     = User::count();
        $totalAdmin    = User::where('role', 'Admin')->count();
        $totalOperator = User::where('role', 'Operator')->count();

        return view('admin.user.index', compact(
            'users', 'totalUser', 'totalAdmin', 'totalOperator'
        ));
    }

    // Menyimpan user baru (dari modal Tambah User)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:30|unique:user,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:Admin,Operator',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'status'   => $validated['status'],
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Memperbarui data user (dari modal Edit User)
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:user,username,' . $user->getKey() . ',' . $user->getKeyName(),
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:Admin,Operator',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->role     = $validated['role'];
        $user->status = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

    // Mengaktifkan / menonaktifkan user
    public function toggleStatus(User $user)
    {
        if ($user->getKey() === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa mengubah status akun sendiri.');
        }

        $user->status = $user->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $user->save();

        return back()->with('success', "User {$user->username} sekarang {$user->status}.");
    }
}

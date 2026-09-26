<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    // Pakai user yang login; fallback ke user pertama selama login belum dibuat
    private function currentUser(): User
    {
        return Auth::user() ?? User::firstOrFail();
    }

    public function index()
    {
        $user   = $this->currentUser();
        $profil = $user->profil;

        return view('admin.akun.index', compact('user', 'profil'));
    }

    public function update(Request $request)
    {
        $user = $this->currentUser();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:40',
            'username'     => 'required|string|max:30|unique:user,username,' . $user->getKey() . ',id_user',
            'jabatan'      => 'nullable|string|max:40',
            'no_hp'        => 'nullable|string|max:15',
            'alamat'       => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profil = $user->profil ?? new ProfileUser(['id_user' => $user->getKey()]);

        $data = collect($validated)->only(['nama_lengkap', 'jabatan', 'no_hp', 'alamat'])->all();

        if ($request->hasFile('foto')) {
            if ($profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('profile_user', 'public');
        }

        $profil->fill($data)->save();

        // Sinkronkan ke tabel user (kolom name wajib terisi)
        $user->update([
            'name'     => $validated['nama_lengkap'],
            'username' => $validated['username'],
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = $this->currentUser();

        $request->validate([
            'password_lama' => 'required|string',
            'password'      => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.index')
            ->with('success', 'Password berhasil diganti.');
    }
}

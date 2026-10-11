<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        return view('admin.profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah'   => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'npsn'           => 'nullable|string|max:10',
            'alamat'         => 'nullable|string',
            'kontak'         => 'nullable|string|max:15',
            'tahun_berdiri'  => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
            'visi'           => 'nullable|string',
            'misi'           => 'nullable|string',
            'deskripsi'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video'          => 'nullable|file|mimes:mp4|max:20480',   // maks. 20 MB
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::first() ?? new Profile();
        $data = $request->except(['foto', 'video', 'hapus_video']);

        $data = collect($validated)->except(['foto', 'logo'])->all();

        foreach (['foto', 'logo'] as $field) {
            if ($request->hasFile($field)) {
                if ($profile->{$field} && Storage::disk('public')->exists($profile->{$field})) {
                    Storage::disk('public')->delete($profile->{$field});
                }
                $data[$field] = $request->file($field)->store('profile', 'public');
            }
        }

        if ($request->boolean('hapus_video') && $profile?->video) {
            Storage::disk('public')->delete($profile->video);
            $data['video'] = null;
        }

        if ($request->hasFile('video')) {
            if ($profile?->video) {
                Storage::disk('public')->delete($profile->video);
            }
            $data['video'] = $request->file('video')->store('profile', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->route('profil-sekolah.index')
            ->with('success', 'Profil sekolah berhasil disimpan.');
    }
}

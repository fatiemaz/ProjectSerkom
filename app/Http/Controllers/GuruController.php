<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $gurus = Guru::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_guru', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%")
                      ->orWhere('mapel', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('jabatan'), function ($query) use ($request) {
                $query->where('jabatan', $request->jabatan);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalGuru      = Guru::count();
        $totalGuruMapel = Guru::where('jabatan', 'Guru Mapel')->count();
        $totalTendik    = Guru::where('jabatan', 'Tenaga Kependidikan')->count();

        return view('admin.guru.index', compact('gurus', 'totalGuru', 'totalGuruMapel', 'totalTendik'));
    }

    public function store(Request $request)
    {
        $request->merge(['_modal' => 'tambah']);

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip'       => 'nullable|string|max:15|unique:guru,nip',
            'mapel'     => 'nullable|string|max:40',
            'jabatan'   => 'required|in:Guru Mapel,Tenaga Kependidikan',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(Request $request, $id_guru)
    {
        $guru = Guru::where('id_guru', $id_guru)->firstOrFail();

        $request->merge([
            '_modal' => 'edit',
            '_guru_id' => $guru->id_guru
        ]);

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip'       => 'nullable|string|max:15|unique:guru,nip,' . $guru->id_guru . ',id_guru',
            'mapel'     => 'nullable|string|max:40',
            'jabatan'   => 'required|in:Guru Mapel,Tenaga Kependidikan',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $validated['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id_guru)
    {
        $guru = Guru::where('id_guru', $id_guru)->firstOrFail();

        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}

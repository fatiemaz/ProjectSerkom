<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $prestasis = Prestasi::with('siswa')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_prestasi', 'like', "%{$search}%")
                      ->orWhere('nama_siswa', 'like', "%{$search}%")
                      ->orWhere('tahun_ajaran', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('tahun_ajaran')
            ->orderBy('nomor')
            ->paginate(10)
            ->withQueryString();

        $totalPrestasi = Prestasi::count();
        $siswas = Siswa::orderBy('nama_siswa')->get();

        return view('admin.prestasi.index', compact('prestasis', 'totalPrestasi', 'siswas'));
    }

    public function create()
    {
        $siswas = Siswa::orderBy('nama_siswa')->get();
        return view('admin.prestasi.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa'      => 'required|exists:siswa,id_siswa',
            'nama_prestasi' => 'required|string|max:40',
            'tingkat'       => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'deskripsi'     => 'nullable|string',
            'tahun_ajaran'  => ['nullable', 'string', 'max:9', 'regex:/^\d{4}\/\d{4}$/'],
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_siswa.required'  => 'Siswa wajib dipilih.',
            'id_siswa.exists'    => 'Siswa yang dipilih tidak ditemukan.',
            'tahun_ajaran.regex' => 'Format tahun ajaran harus seperti 2025/2026.',
        ]);

        // nama_siswa diambil dari data siswa agar halaman publik tetap berjalan
        $validated['nama_siswa'] = Siswa::findOrFail($validated['id_siswa'])->nama_siswa;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        $siswas = Siswa::orderBy('nama_siswa')->get();
        return view('admin.prestasi.edit', compact('prestasi', 'siswas'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'id_siswa'      => 'required|exists:siswa,id_siswa',
            'nama_prestasi' => 'required|string|max:40',
            'tingkat'       => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'deskripsi'     => 'nullable|string',
            'tahun_ajaran'  => ['nullable', 'string', 'max:9', 'regex:/^\d{4}\/\d{4}$/'],
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'id_siswa.required'  => 'Siswa wajib dipilih.',
            'id_siswa.exists'    => 'Siswa yang dipilih tidak ditemukan.',
            'tahun_ajaran.regex' => 'Format tahun ajaran harus seperti 2025/2026.',
        ]);

        $validated['nama_siswa'] = Siswa::findOrFail($validated['id_siswa'])->nama_siswa;

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}

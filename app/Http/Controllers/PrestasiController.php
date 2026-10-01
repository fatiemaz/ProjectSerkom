<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $prestasis = Prestasi::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_prestasi', 'like', "%{$search}%")
                      ->orWhere('tahun_ajaran', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('tahun_ajaran')
            ->orderBy('nomor')
            ->paginate(10)
            ->withQueryString();

        $totalPrestasi = Prestasi::count();

        return view('admin.prestasi.index', compact('prestasis', 'totalPrestasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:40',
            'deskripsi'     => 'nullable|string',
            'tahun_ajaran'  => ['nullable', 'string', 'max:9', 'regex:/^\d{4}\/\d{4}$/'],
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'tahun_ajaran.regex' => 'Format tahun ajaran harus seperti 2025/2026.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:40',
            'deskripsi'     => 'nullable|string',
            'tahun_ajaran'  => ['nullable', 'string', 'max:9', 'regex:/^\d{4}\/\d{4}$/'],
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'tahun_ajaran.regex' => 'Format tahun ajaran harus seperti 2025/2026.',
        ]);

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

<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswas = Siswa::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%")
                      ->orWhere('nisn', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('jenis_kelamin'), function ($query) use ($request) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            })
            ->orderBy('nomor')
            ->paginate(10)
            ->withQueryString();

        $totalSiswa     = Siswa::count();
        $totalLaki      = Siswa::where('jenis_kelamin', 'Laki-Laki')->count();
        $totalPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();

        return view('admin.siswa.index', compact(
            'siswas', 'totalSiswa', 'totalLaki', 'totalPerempuan'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn'          => 'nullable|string|max:10|unique:siswa,nisn',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nisn'          => 'nullable|string|max:10|unique:siswa,nisn,' . $siswa->getKey() . ',id_siswa',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'nullable|integer|digits:4|min:1900|max:' . date('Y'),
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}

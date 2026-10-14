<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

/**
 * FILE: app/Http/Controllers/KelasController.php
 * CRUD data kelas di panel admin.
 */
class KelasController extends Controller
{
    public function index(Request $request)
    {
        $daftarKelas = Kelas::query()
            ->withCount('siswa') // menghasilkan $kelas->siswa_count
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama_kelas', 'like', '%' . $request->search . '%');
            })
            ->orderBy('nama_kelas')
            ->paginate(10)
            ->withQueryString();

        // Statistik untuk kartu di atas tabel
        $totalKelas = Kelas::count();
        $totalSiswa = Siswa::count();
        $rataRata   = $totalKelas > 0 ? round($totalSiswa / $totalKelas, 1) : 0;

        return view('admin.kelas.index', compact('daftarKelas', 'totalKelas', 'totalSiswa', 'rataRata'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:20|unique:kelas,nama_kelas',
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah ada.',
        ]);

        Kelas::create($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            // abaikan dirinya sendiri saat cek unik
            'nama_kelas' => 'required|string|max:20|unique:kelas,nama_kelas,' . $kelas->getKey() . ',id_kelas',
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah ada.',
        ]);

        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        // Kelas yang masih punya siswa tidak boleh dihapus
        // (foreign key juga akan menolak, ini supaya pesannya ramah)
        if ($kelas->siswa()->exists()) {
            return redirect()->route('kelas.index')
                ->with('error', 'Kelas tidak bisa dihapus karena masih memiliki siswa. Pindahkan siswanya terlebih dahulu.');
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}

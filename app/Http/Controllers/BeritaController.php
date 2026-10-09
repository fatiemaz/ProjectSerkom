<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritas = Berita::with('user')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $totalBerita  = Berita::count();
        $totalPublish = Berita::where('status', 'Publish')->count();
        $totalDraft   = Berita::where('status', 'Draft')->count();

        return view('admin.berita.index', compact(
            'beritas', 'totalBerita', 'totalPublish', 'totalDraft'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:150',
            'isi'     => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status'  => 'required|in:Publish,Draft',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Pakai user yang login; fallback ke user pertama selama login belum dibuat
        $validated['id_user'] = Auth::id() ?? User::value('id_user');

        // Catatan: Slug akan otomatis di-generate oleh model Berita (lewat booted event)
        Berita::create($validated);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    public function update(Request $request, $id_berita)
    {
        // 1. Cari data berita berdasarkan id_berita
        $berita = Berita::where('id_berita', $id_berita)->firstOrFail();

        // 2. Validasi input form
        $validated = $request->validate([
            'judul'   => 'required|string|max:150',
            'isi'     => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status'  => 'required|in:Publish,Draft',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 3. Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // 4. Update data ke database
        $berita->update($validated);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id_berita)
    {
        $berita = Berita::where('id_berita', $id_berita)->firstOrFail();

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}

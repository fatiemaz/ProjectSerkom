<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeris = Galeri::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $totalGaleri = Galeri::count();
        $totalFoto   = Galeri::where('kategori', 'Foto')->count();
        $totalVideo  = Galeri::where('kategori', 'Video')->count();

        return view('admin.galeri.index', compact(
            'galeris', 'totalGaleri', 'totalFoto', 'totalVideo'
        ));
    }

    // Aturan file mengikuti kategori: Foto = gambar, Video = mp4/webm/mov
    private function fileRules(Request $request): string
    {
        return $request->kategori === 'Video'
            ? 'mimes:mp4,webm,mov|max:20480'
            : 'image|mimes:jpg,jpeg,png,webp|max:2048';
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'nullable|date',
            'file'       => 'required|' . $this->fileRules($request),
        ]);

        $validated['file'] = $request->file('file')->store('galeri', 'public');

        Galeri::create($validated);

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'nullable|date',
            'file'       => 'nullable|' . $this->fileRules($request),
        ]);

        // Kategori berubah (Foto <-> Video) tapi file lama tidak cocok lagi
        if ($galeri->kategori !== $validated['kategori'] && !$request->hasFile('file')) {
            return back()
                ->withInput()
                ->withErrors(['file' => 'Kategori diubah, silakan upload file baru.']);
        }

        if ($request->hasFile('file')) {
            if ($galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }
            $validated['file'] = $request->file('file')->store('galeri', 'public');
        } else {
            unset($validated['file']);
        }

        $galeri->update($validated);

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}

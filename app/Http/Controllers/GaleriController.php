<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeris = Galeri::when($request->filled('search'), function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function store(Request $request)
    {
        $request->merge(['_modal' => 'tambah']);

        $validated = $request->validate([
            'judul'      => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'kategori'   => 'nullable|in:Foto,Video',
            'tanggal'    => 'nullable|date',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('galeri', 'public');
        }

        Galeri::create($validated);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update(Request $request, $id_galeri)
    {
        $galeri = Galeri::where('id_galeri', $id_galeri)->firstOrFail();

        $request->merge([
            '_modal' => 'edit',
            '_galeri_id' => $galeri->id_galeri
        ]);

        $validated = $request->validate([
            'judul'      => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'kategori'   => 'nullable|in:Foto,Video',
            'tanggal'    => 'nullable|date',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }
            $validated['file'] = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id_galeri)
    {
        $galeri = Galeri::where('id_galeri', $id_galeri)->firstOrFail();

        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}

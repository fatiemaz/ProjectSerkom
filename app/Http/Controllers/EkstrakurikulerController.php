<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $ekskuls = Ekstrakurikuler::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nama_ekskul', 'like', "%{$search}%")
                      ->orWhere('pembina', 'like', "%{$search}%");
                });
            })
            ->orderBy('nomor')
            ->paginate(10)
            ->withQueryString();

        $totalEkskul = Ekstrakurikuler::count();

        return view('admin.ekstrakurikuler.index', compact('ekskuls', 'totalEkskul'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ekskul'    => 'required|string|max:40',
            'pembina'        => 'nullable|string|max:40',
            'jadwal_latihan' => 'nullable|string|max:40',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create($validated);

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $validated = $request->validate([
            'nama_ekskul'    => 'required|string|max:40',
            'pembina'        => 'nullable|string|max:40',
            'jadwal_latihan' => 'nullable|string|max:40',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update($validated);

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    private array $rules = [
        'nama'      => 'required|string|max:40',
        'deskripsi' => 'nullable|string|max:150',
        'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        Fasilitas::create($validated);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $request->validate($this->rules);

        if ($request->hasFile('foto')) {
            if ($fasilita->foto) {
                Storage::disk('public')->delete($fasilita->foto);
            }
            $validated['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        $fasilita->update($validated);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        if ($fasilita->foto) {
            Storage::disk('public')->delete($fasilita->foto);
        }

        $fasilita->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $pengumumans = Pengumuman::with('user')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $totalPengumuman = Pengumuman::count();
        $totalPublish    = Pengumuman::where('status', 'Publish')->count();
        $totalDraft      = Pengumuman::where('status', 'Draft')->count();

        return view('admin.pengumuman.index', compact(
            'pengumumans', 'totalPengumuman', 'totalPublish', 'totalDraft'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:50',
            'isi'     => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status'  => 'required|in:Publish,Draft',
        ]);

        // Pakai user yang login; fallback ke user pertama selama login belum dibuat
        $validated['id_user'] = Auth::id() ?? User::value('id_user');

        Pengumuman::create($validated);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:50',
            'isi'     => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status'  => 'required|in:Publish,Draft',
        ]);

        $pengumuman->update($validated);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}

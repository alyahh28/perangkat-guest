<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = PerangkatDesa::with('warga');

        // Filter Status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'Aktif') {
                $query->whereNull('periode_selesai')
                      ->orWhere('periode_selesai', '>', now());
            } elseif ($request->status == 'Tidak Aktif') {
                $query->whereNotNull('periode_selesai')
                      ->where('periode_selesai', '<=', now());
            }
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('jabatan', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('nip', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('kontak', 'LIKE', '%' . $request->search . '%')
                  ->orWhereHas('warga', function($wargaQuery) use ($request) {
                      $wargaQuery->where('nama', 'LIKE', '%' . $request->search . '%');
                  });
            });
        }

        $data['dataPerangkat'] = $query->paginate(10)->withQueryString();

        return view('pages.perangkat.index', $data);
    }

    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|max:100',
            'nip' => 'nullable|max:20',
            'kontak' => 'required|max:15',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        PerangkatDesa::create($data);

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // --- FUNGSI SHOW (DETAIL) ---
    public function show($id)
    {
        // Sekarang ini tidak akan error karena Model sudah diperbaiki
        $perangkat = PerangkatDesa::with(['warga', 'media'])->findOrFail($id);

        return view('pages.perangkat.show', compact('perangkat'));
    }

    public function edit(string $id)
    {
        $data['dataPerangkat'] = PerangkatDesa::findOrFail($id);
        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|max:100',
            'nip' => 'nullable|max:20',
            'kontak' => 'required|max:15',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $perangkat = PerangkatDesa::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        $perangkat->update($data);

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil dihapus!');
    }
}

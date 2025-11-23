<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder; // Tambahkan import ini

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status_aktif']; // Kolom untuk filter status
        $searchTableColumns = ['jabatan', 'nip', 'kontak']; // Kolom yang bisa dicari

        // Query dengan relasi warga
        $query = PerangkatDesa::with('warga');

        // Filter berdasarkan status aktif/tidak aktif
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'Aktif') {
                $query->whereNull('periode_selesai')
                      ->orWhere('periode_selesai', '>', now());
            } elseif ($request->status == 'Tidak Aktif') {
                $query->whereNotNull('periode_selesai')
                      ->where('periode_selesai', '<=', now());
            }
        }

        // Search berdasarkan nama warga, jabatan, atau NIP
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
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

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        PerangkatDesa::create($data);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPerangkat'] = PerangkatDesa::findOrFail($id);
        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
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

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($perangkat->foto) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
            $data['foto'] = $fotoPath;
        }

        $perangkat->update($data);

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        // Hapus foto jika ada
        if ($perangkat->foto) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();

        return redirect()->route('perangkat.index')->with('success', 'Data perangkat desa berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPerangkat'] = PerangkatDesa::with('warga')->get();
        return view('guest.perangkat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('guest.perangkat.create', $data);
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
        return view('guest.perangkat.edit', $data);
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

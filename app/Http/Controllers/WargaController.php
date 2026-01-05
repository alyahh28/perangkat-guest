<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin']; // Sesuaikan dengan kolom yang ada
        $searchTableColumns = ['nama', 'no_ktp', 'pekerjaan']; // Kolom yang bisa dicari

        // Calculate Stats
        $stats = [
            'total_warga' => Warga::count(),
            'laki_laki' => Warga::where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => Warga::where('jenis_kelamin', 'Perempuan')->count(),
            'kepala_keluarga' => round(Warga::count() / 3), // Estimasi KK
        ];

        $query = Warga::query();

        // Apply filter
        $query->filter($request, $filterableColumns);

        // Apply search
        $query->search($request, $searchTableColumns);

        $data['dataWarga'] = $query->paginate(9)->withQueryString();
        $data['stats'] = $stats;

        return view('pages.warga.index', $data);
    }

    // Method lainnya tetap sama...
    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga|max:16',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ktp' => 'required|max:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data berhasil dihapus!');
    }
}

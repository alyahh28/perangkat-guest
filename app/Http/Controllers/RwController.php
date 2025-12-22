<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function index()
    {
        // Mengambil data terbaru dengan pagination 10 item per halaman
        $rws = Rw::latest()->paginate(10);
        return view('pages.rw.index', compact('rws'));
    }

    public function create()
    {
        return view('pages.rw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rw' => 'required|unique:rws,no_rw|max:10',
            'ketua_rw' => 'required|string|max:255',
        ], [
            'no_rw.unique' => 'Nomor RW sudah terdaftar.',
            'no_rw.required' => 'Nomor RW wajib diisi.',
            'ketua_rw.required' => 'Nama Ketua RW wajib diisi.',
        ]);

        Rw::create($request->all());

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $rw = Rw::findOrFail($id);
        return view('pages.rw.edit', compact('rw'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_rw' => 'required|max:10|unique:rws,no_rw,' . $id,
            'ketua_rw' => 'required|string|max:255',
        ]);

        $rw = Rw::findOrFail($id);
        $rw->update($request->all());

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $rw = Rw::findOrFail($id);
        $rw->delete();

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil dihapus!');
    }
}

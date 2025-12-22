<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function index()
    {
        // Ambil data RT beserta data RW-nya (Eager Loading)
        $rts = Rt::with('rw')->latest()->paginate(10);
        return view('pages.rt.index', compact('rts'));
    }

    public function create()
    {
        $rws = Rw::all(); // Data RW untuk dropdown
        return view('pages.rt.create', compact('rws'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'no_rt' => 'required|numeric',
            'ketua_rt' => 'required|string|max:255',
        ], [
            'rw_id.required' => 'Silakan pilih RW.',
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'ketua_rt.required' => 'Nama Ketua RT wajib diisi.',
        ]);

        Rt::create($request->all());

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $rt = Rt::findOrFail($id);
        $rws = Rw::all(); // Data RW untuk dropdown
        return view('pages.rt.edit', compact('rt', 'rws'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'rw_id' => 'required|exists:rws,id',
            'no_rt' => 'required|numeric',
            'ketua_rt' => 'required|string|max:255',
        ]);

        $rt = Rt::findOrFail($id);
        $rt->update($request->all());

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $rt = Rt::findOrFail($id);
        $rt->delete();

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil dihapus!');
    }
}

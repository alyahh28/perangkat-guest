<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $data['dataWarga'] = Warga::all();
        return view('guest.warga.index', $data);
    }

    public function create()
    {
        return view('guest.warga.create');
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
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('guest.warga.edit', $data);
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

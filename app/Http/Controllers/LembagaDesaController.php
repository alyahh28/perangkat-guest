<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LembagaDesaController extends Controller
{
    public function index(Request $request)
    {
        $searchTableColumns = ['nama_lembaga', 'deskripsi', 'kontak'];

        $query = LembagaDesa::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request, $searchTableColumns) {
                foreach ($searchTableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }

        $lembaga = $query->orderBy('nama_lembaga')->paginate(10)->withQueryString();

        return view('pages.lembaga_desa.index', compact('lembaga'));
    }

    public function create()
    {
        return view('pages.lembaga_desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi logo
        ]);

        $data = $request->except('logo');

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . Str::slug($request->nama_lembaga) . '_' . time() . '.' . $logoFile->getClientOriginalExtension();

            // Simpan ke storage
            $logoPath = $logoFile->storeAs('public/logos', $logoName);
            $data['logo'] = $logoName;
        }

        LembagaDesa::create($data);

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('pages.lembaga_desa.show', compact('lembaga'));
    }

    public function edit($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);
        return view('pages.lembaga_desa.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $lembaga = LembagaDesa::findOrFail($id);
        $data = $request->except('logo');

        // Upload logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($lembaga->logo) {
                Storage::delete('public/logos/' . $lembaga->logo);
            }

            $logoFile = $request->file('logo');
            $logoName = 'logo_' . Str::slug($request->nama_lembaga) . '_' . time() . '.' . $logoFile->getClientOriginalExtension();

            $logoPath = $logoFile->storeAs('public/logos', $logoName);
            $data['logo'] = $logoName;
        }

        $lembaga->update($data);

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);

        // Hapus logo jika ada
        if ($lembaga->logo) {
            Storage::delete('public/logos/' . $lembaga->logo);
        }

        $lembaga->delete();

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil dihapus.');
    }
}

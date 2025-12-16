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
    $lembaga = LembagaDesa::findOrFail($id);

    // 1. Update Data Utama
    $lembaga->update([
        'nama_lembaga' => $request->nama_lembaga,
        'singkatan'    => $request->singkatan,
        'alamat'       => $request->alamat,
        'deskripsi'    => $request->deskripsi,
        // field lain...
    ]);

    // 2. Hapus Logo Single Lama (Jika dicentang)
    if ($request->has('remove_logo')) {
        if ($lembaga->logo) {
            Storage::delete('public/logos/' . $lembaga->logo); // Hapus file fisik
            $lembaga->update(['logo' => null]); // Set null di DB
        }
    }

    // 3. Update Caption & Urutan Media Existing
    if ($request->has('captions')) {
        foreach ($request->captions as $mediaId => $caption) {
            $media = Media::find($mediaId);
            if ($media) {
                $media->update([
                    'caption' => $caption,
                    'sort_order' => $request->sort_orders[$mediaId] ?? 0
                ]);
            }
        }
    }

    // 4. Hapus Media (Multiple)
    if ($request->has('remove_media')) {
        foreach ($request->remove_media as $mediaId) {
            $media = Media::find($mediaId);
            if ($media) {
                Storage::delete('public/uploads/' . $media->file_name); // Hapus file fisik
                $media->delete(); // Hapus record DB
            }
        }
    }

    // 5. Upload Logo Baru (Multiple)
    if ($request->hasFile('logos')) {
        foreach ($request->file('logos') as $index => $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);

            // Simpan ke tabel Media
$lembaga->media()->create([
    'ref_table'  => 'data', // <--- TAMBAHKAN BARIS INI (Wajib)
    'file_name'  => $filename,
    'caption'    => $request->captions_new[$index] ?? null,
    'sort_order' => $request->sort_orders_new[$index] ?? 0,
    'mime_type'  => 'image/jpeg', // Ganti 'file_type' jadi 'mime_type' sesuai Model Anda
]);
        }
    }

    return redirect()->route('lembaga.index')->with('success', 'Data berhasil diperbarui');
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

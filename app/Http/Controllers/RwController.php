<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Rt;
use Illuminate\Http\Request;

use App\Models\Warga; // Added Warga

class RwController extends Controller
{
    public function index()
    {
        // Calculate Stats
        $stats = [
            'total_rw' => Rw::count(),
            'ketua_terisi' => Rw::whereNotNull('ketua_rw_warga_id')->count(),
            'total_rt' => Rt::count(),
            'rw_baru' => Rw::where('created_at', '>=', now()->subMonth())->count(),
        ];

        // Mengambil data terbaru dengan pagination 10 item per halaman
        $rws = Rw::with('ketua')->latest()->paginate(9);
        return view('pages.rw.index', compact('rws', 'stats'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('pages.rw.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rw' => 'required|unique:rws,nomor_rw|max:10',
            'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nomor_rw.unique' => 'Nomor RW sudah terdaftar.',
            'nomor_rw.required' => 'Nomor RW wajib diisi.',
            'ketua_rw_warga_id.exists' => 'Warga tidak ditemukan.',
        ]);

        $rw = Rw::create($request->all());

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public'); // Simpan di disk public

            \App\Models\Media::create([
                'ref_table' => 'rws',
                'ref_id' => $rw->rw_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil RW ' . $rw->nomor_rw,
            ]);
        }

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $rw = Rw::findOrFail($id);
        $wargas = Warga::all();
        return view('pages.rw.edit', compact('rw', 'wargas'));
    }

    public function update(Request $request, string $id)
    {
        $rw = Rw::findOrFail($id);

        $request->validate([
            'nomor_rw' => 'required|max:10|unique:rws,nomor_rw,' . $id . ',rw_id',
            'ketua_rw_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rw->update($request->except('foto_profil'));

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            $oldMedia = $rw->foto_profile;
            if ($oldMedia) {
                $oldMedia->delete(); // Ini akan memicu event deleting di model Media utk hapus file
            }

            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            \App\Models\Media::create([
                'ref_table' => 'rws',
                'ref_id' => $rw->rw_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil RW ' . $rw->nomor_rw,
            ]);
        }

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $rw = Rw::findOrFail($id);
        
        // Hapus media terkait
        if ($rw->foto_profile) {
            $rw->foto_profile->delete();
        }
        
        $rw->delete();

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil dihapus!');
    }
}

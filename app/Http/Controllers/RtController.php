<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;

use App\Models\Warga; // Added Warga

class RtController extends Controller
{
    public function index()
    {
        // Calculate Stats
        $stats = [
            'total_rt' => Rt::count(),
            'total_rw' => Rw::count(), // Total RW as context
            'ketua_terisi' => Rt::whereNotNull('ketua_rt_warga_id')->count(),
            'rt_baru' => Rt::where('created_at', '>=', now()->subMonth())->count(), // RT added in the last month
        ];

        // Ambil data RT beserta data RW-nya (Eager Loading)
        $rts = Rt::with(['rw', 'ketua'])->latest()->paginate(9);
        return view('pages.rt.index', compact('rts', 'stats'));
    }

    public function create()
    {
        $rws = Rw::all(); // Data RW untuk dropdown
        $wargas = Warga::all(); // Data Warga untuk dropdown
        return view('pages.rt.create', compact('rws', 'wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw_id' => 'required|exists:rws,rw_id',
            'nomor_rt' => 'required|numeric',
            'ketua_rt_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'rw_id.required' => 'Silakan pilih RW.',
            'nomor_rt.required' => 'Nomor RT wajib diisi.',
        ]);

        $rt = Rt::create($request->all());

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            \App\Models\Media::create([
                'ref_table' => 'rts',
                'ref_id' => $rt->rt_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil RT ' . $rt->nomor_rt . ' RW ' . $rt->rw_id,
            ]);
        }

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $rt = Rt::findOrFail($id);
        $rws = Rw::all(); // Data RW untuk dropdown
        $wargas = Warga::all();
        return view('pages.rt.edit', compact('rt', 'rws', 'wargas'));
    }

    public function update(Request $request, string $id)
    {
        $rt = Rt::findOrFail($id);

        $request->validate([
            'rw_id' => 'required|exists:rws,rw_id',
            'nomor_rt' => 'required|numeric',
            'ketua_rt_warga_id' => 'nullable|exists:warga,warga_id',
            'keterangan' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rt->update($request->except('foto_profil'));

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            $oldMedia = $rt->foto_profile;
            if ($oldMedia) {
                $oldMedia->delete();
            }

            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            \App\Models\Media::create([
                'ref_table' => 'rts',
                'ref_id' => $rt->rt_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil RT ' . $rt->nomor_rt,
            ]);
        }

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $rt = Rt::findOrFail($id);
        
        if ($rt->foto_profile) {
            $rt->foto_profile->delete();
        }

        $rt->delete();

        return redirect()->route('rt.index')->with('success', 'Data RT berhasil dihapus!');
    }
}

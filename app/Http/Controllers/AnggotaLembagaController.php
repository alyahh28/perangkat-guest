<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\JabatanLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Warga;
use App\Models\Media; // Added Media

class AnggotaLembagaController extends Controller
{
    public function index()
    {
        // Calculate Stats
        $stats = [
            'total_anggota' => AnggotaLembaga::count(),
            'total_lembaga' => LembagaDesa::count(),
            'total_jabatan' => JabatanLembaga::count(),
            'anggota_baru' => AnggotaLembaga::where('created_at', '>=', now()->subMonth())->count(),
        ];

        // Eager load warga as well
        $anggotas = AnggotaLembaga::with(['lembaga', 'jabatan', 'warga'])->latest()->paginate(9);
        return view('pages.anggota_lembaga.index', compact('anggotas', 'stats'));
    }

    public function create()
    {
        $lembagas = LembagaDesa::all();
        $jabatans = JabatanLembaga::all();
        $wargas = Warga::all();
        return view('pages.anggota_lembaga.create', compact('lembagas', 'jabatans', 'wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'jabatan_id' => 'required|exists:jabatan_lembaga,jabatan_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'tgl_mulai'  => 'required|date',
            'tgl_selesai'=> 'nullable|date|after_or_equal:tgl_mulai',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $anggota = AnggotaLembaga::create($request->all());

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            \App\Models\Media::create([
                'ref_table' => 'anggota_lembagas',
                'ref_id' => $anggota->anggota_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil Anggota Lembaga',
            ]);
        }

        return redirect()->route('anggota-lembaga.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $anggota = AnggotaLembaga::findOrFail($id);
        $lembagas = LembagaDesa::all();
        $jabatans = JabatanLembaga::all();
        $wargas = Warga::all();
        return view('pages.anggota_lembaga.edit', compact('anggota', 'lembagas', 'jabatans', 'wargas'));
    }

    public function show($id)
    {
        $anggota = AnggotaLembaga::with(['lembaga', 'jabatan', 'warga', 'foto_profile'])->findOrFail($id);
        return view('pages.anggota_lembaga.show', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $anggota = AnggotaLembaga::findOrFail($id);

        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'jabatan_id' => 'required|exists:jabatan_lembaga,jabatan_id',
            'warga_id'   => 'required|exists:warga,warga_id',
            'tgl_mulai'  => 'required|date',
            'tgl_selesai'=> 'nullable|date|after_or_equal:tgl_mulai',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $anggota->update($request->except('foto_profil'));

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            $oldMedia = $anggota->foto_profile;
            if ($oldMedia) {
                $oldMedia->delete();
            }

            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            \App\Models\Media::create([
                'ref_table' => 'anggota_lembagas',
                'ref_id' => $anggota->anggota_id,
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Profil Anggota Lembaga',
            ]);
        }

        return redirect()->route('anggota-lembaga.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $anggota = AnggotaLembaga::findOrFail($id);

        // Hapus media terkait
        if ($anggota->foto_profile) {
            $anggota->foto_profile->delete();
        }

        $anggota->delete();

        return redirect()->route('anggota-lembaga.index')->with('success', 'Anggota berhasil dihapus!');
    }
}

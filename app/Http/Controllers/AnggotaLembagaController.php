<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\JabatanLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaLembagaController extends Controller
{
    public function index()
    {
        $anggotas = AnggotaLembaga::with(['lembaga', 'jabatan'])->latest()->paginate(10);
        return view('pages.anggota_lembaga.index', compact('anggotas'));
    }

    public function create()
    {
        $lembagas = LembagaDesa::all();
        $jabatans = JabatanLembaga::all();
        return view('pages.anggota_lembaga.create', compact('lembagas', 'jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // PERBAIKAN DI SINI:
            // Format validation: exists:nama_tabel,nama_kolom
            // Kita ubah dari 'id' menjadi 'lembaga_id' dan 'jabatan_id'
            'lembaga_desa_id' => 'required|exists:lembaga_desa,lembaga_id',
            'jabatan_lembaga_id' => 'required|exists:jabatan_lembaga,jabatan_id',

            'nama' => 'required|string|max:255',
            'nomor_anggota' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('anggota-images', 'public');
        }

        AnggotaLembaga::create($data);

        return redirect()->route('anggota-lembaga.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $anggota = AnggotaLembaga::findOrFail($id);
        $lembagas = LembagaDesa::all();
        $jabatans = JabatanLembaga::all();
        return view('pages.anggota_lembaga.edit', compact('anggota', 'lembagas', 'jabatans'));
    }

    public function show($id)
    {
        // Mengambil data anggota beserta relasi lembaga dan jabatan
        $anggota = AnggotaLembaga::with(['lembaga', 'jabatan'])->findOrFail($id);

        return view('pages.anggota_lembaga.show', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            // PERBAIKAN DI SINI JUGA:
            'lembaga_desa_id' => 'required|exists:lembaga_desa,lembaga_id',
            'jabatan_lembaga_id' => 'required|exists:jabatan_lembaga,jabatan_id',

            'nama' => 'required|string|max:255',
            'nomor_anggota' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $anggota = AnggotaLembaga::findOrFail($id);
        $data = $request->all();

        // Cek jika ada foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('anggota-images', 'public');
        }

        $anggota->update($data);

        return redirect()->route('anggota-lembaga.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $anggota = AnggotaLembaga::findOrFail($id);

        // Hapus foto dari storage saat data dihapus
        if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()->route('anggota-lembaga.index')->with('success', 'Anggota berhasil dihapus!');
    }
}

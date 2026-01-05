<?php

namespace App\Http\Controllers;

use App\Models\JabatanLembaga;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder; // Tambahkan import ini

class JabatanLembagaController extends Controller
{
    public function index(Request $request)
    {
        $searchTableColumns = ['nama_jabatan']; // Kolom yang bisa dicari

        // Calculate Stats
        $stats = [
            'total_jabatan' => JabatanLembaga::count(),
            'total_lembaga' => LembagaDesa::count(),
            'jabatan_level_1' => JabatanLembaga::where('level', 1)->count(), // e.g. Ketua
            'jabatan_terisi' => JabatanLembaga::has('anggota')->count(),
        ];

        // Query dengan relasi lembaga
        $query = JabatanLembaga::with('lembaga');

        // Filter berdasarkan lembaga jika ada
        if ($request->has('lembaga_id') && $request->lembaga_id != '') {
            $query->where('lembaga_id', $request->lembaga_id);
        }

        // Filter berdasarkan level jika ada
        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }

        // Terapkan search jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request, $searchTableColumns) {
                foreach ($searchTableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
                // Juga search berdasarkan nama lembaga
                $q->orWhereHas('lembaga', function($lembagaQuery) use ($request) {
                    $lembagaQuery->where('nama_lembaga', 'LIKE', '%' . $request->search . '%');
                });
            });
        }

        $jabatan = $query->orderBy('level')
            ->orderBy('nama_jabatan')
            ->paginate(9)
            ->withQueryString();

        $lembagaList = LembagaDesa::orderBy('nama_lembaga')->get();


        $lembagaList = LembagaDesa::orderBy('nama_lembaga')->get();

        return view('pages.jabatan_lembaga.index', compact('jabatan', 'lembagaList', 'stats'));
    }

    public function create()
    {
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.create', compact('lembaga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10'
        ]);

        JabatanLembaga::create($request->all());

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan lembaga berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jabatan = JabatanLembaga::with(['lembaga', 'anggota'])->findOrFail($id);
        return view('pages.jabatan_lembaga.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $lembaga = LembagaDesa::orderBy('nama_lembaga')->get();
        return view('pages.jabatan_lembaga.edit', compact('jabatan', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:10'
        ]);

        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan lembaga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = JabatanLembaga::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan-lembaga.index')
            ->with('success', 'Jabatan lembaga berhasil dihapus.');
    }
}

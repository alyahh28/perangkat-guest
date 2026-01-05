<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        // Calculate Stats
        $stats = [
            'total_perangkat' => PerangkatDesa::count(),
            'perangkat_aktif' => PerangkatDesa::where(function($q) {
                $q->whereNull('periode_selesai')
                  ->orWhere('periode_selesai', '>', now());
            })->count(),
            'perangkat_nonaktif' => PerangkatDesa::whereNotNull('periode_selesai')
                  ->where('periode_selesai', '<=', now())->count(),
            'perangkat_baru' => PerangkatDesa::where('created_at', '>=', now()->subMonth())->count(),
        ];

        $query = PerangkatDesa::with('warga');

        // Filter Status
        if ($request->filled('status')) {
            if ($request->status == 'Aktif') {
                $query->where(function($q) {
                    $q->whereNull('periode_selesai')
                      ->orWhere('periode_selesai', '>', now());
                });
            } elseif ($request->status == 'Tidak Aktif') {
                $query->whereNotNull('periode_selesai')
                      ->where('periode_selesai', '<=', now());
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('jabatan', 'LIKE', '%' . $search . '%')
                  ->orWhere('nip', 'LIKE', '%' . $search . '%')
                  ->orWhere('kontak', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('warga', function($wargaQuery) use ($search) {
                      $wargaQuery->where('nama', 'LIKE', '%' . $search . '%');
                  });
            });
        }


        $data['dataPerangkat'] = $query->paginate(9)->withQueryString();
        $data['stats'] = $stats;

        return view('pages.perangkat.index', $data);
    }

    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|max:100',
            'nip' => 'nullable|max:20',
            'kontak' => 'required|max:15',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $data = $request->except(['foto']);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
                $data['foto'] = $fotoPath;
            }

            PerangkatDesa::create($data);
        });

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $perangkat = PerangkatDesa::with(['warga', 'galeri' => function($q) {
            $q->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        return view('pages.perangkat.show', compact('perangkat'));
    }

    public function edit(string $id)
    {
        $data['dataPerangkat'] = PerangkatDesa::with(['galeri' => function($q) {
            $q->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        $data['dataWarga'] = Warga::all();
        return view('pages.perangkat.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'jabatan' => 'required|max:100',
            'nip' => 'nullable|max:20',
            'kontak' => 'required|max:15',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request, $id) {
            $perangkat = PerangkatDesa::findOrFail($id);

            $data = $request->except(['foto', 'fotos', 'captions', 'sort_orders', 'remove_media', 'captions_new', 'sort_orders_new']);

            // 1. Update Foto Utama
            if ($request->hasFile('foto')) {
                if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                    Storage::disk('public')->delete($perangkat->foto);
                }
                $fotoPath = $request->file('foto')->store('perangkat_desa', 'public');
                $data['foto'] = $fotoPath;
            }

            $perangkat->update($data);

            // 2. Hapus Media
            if ($request->has('remove_media')) {
                $mediaToDelete = Media::whereIn('media_id', $request->remove_media)->get();
                foreach ($mediaToDelete as $media) {
                    if (Storage::disk('public')->exists('uploads/' . $media->file_name)) {
                        Storage::disk('public')->delete('uploads/' . $media->file_name);
                    }
                    $media->delete();
                }
            }

            // 3. Update Caption Media
            if ($request->has('captions')) {
                foreach ($request->captions as $mediaId => $caption) {
                    Media::where('media_id', $mediaId)->update([
                        'caption' => $caption,
                        'sort_order' => $request->sort_orders[$mediaId] ?? 0
                    ]);
                }
            }

            // 4. Upload Media Baru
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $key => $file) {
                    $filename = $file->store('uploads', 'public');
                    $filenameOnly = basename($filename);

                    Media::create([
                        'ref_table' => 'perangkat_desa',
                        'ref_id' => $perangkat->perangkat_id,
                        'file_name' => $filenameOnly,
                        'caption' => $request->captions_new[$key] ?? null,
                        'sort_order' => $request->sort_orders_new[$key] ?? 0,
                    ]);
                }
            }
        });

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $perangkat = PerangkatDesa::with('media')->findOrFail($id);

        DB::transaction(function () use ($perangkat) {
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }

            if ($perangkat->media) {
                foreach ($perangkat->media as $media) {
                    if (Storage::disk('public')->exists('uploads/' . $media->file_name)) {
                        Storage::disk('public')->delete('uploads/' . $media->file_name);
                    }
                    $media->delete();
                }
            }

            $perangkat->delete();
        });

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil dihapus!');
    }
}

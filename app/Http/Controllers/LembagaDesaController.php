<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LembagaDesaController extends Controller
{
    public function index(Request $request)
    {
        $searchTableColumns = ['nama_lembaga', 'deskripsi', 'kontak'];
        $query = LembagaDesa::with('media');

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
            'logos' => 'nullable|array',
            'logos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['logos', 'captions', 'sort_orders']);

        // Upload single logo untuk backward compatibility
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . Str::slug($request->nama_lembaga) . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->storeAs('public/logos', $logoName);
            $data['logo'] = $logoName;
        }

        // Create Lembaga Desa
        $lembaga = LembagaDesa::create($data);

        // Upload multiple logos to media table
        if ($request->hasFile('logos')) {
            foreach ($request->file('logos') as $index => $logo) {
                $fileName = time() . '_' . $index . '_' . $logo->getClientOriginalName();
                $path = $logo->storeAs('public/uploads', $fileName);

                Media::create([
                    'ref_table' => 'lembaga_desa',
                    'ref_id' => $lembaga->lembaga_id,
                    'file_name' => $fileName,
                    'caption' => $request->captions[$index] ?? null,
                    'mime_type' => $logo->getMimeType(),
                    'sort_order' => $request->sort_orders[$index] ?? $index,
                ]);
            }
        }

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lembaga = LembagaDesa::with('media')->findOrFail($id);
        return view('pages.lembaga_desa.show', compact('lembaga'));
    }

public function edit($id)
    {
        $lembaga = LembagaDesa::with('media')->findOrFail($id);
        return view('pages.lembaga_desa.edit', compact('lembaga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logos' => 'nullable|array',
            'logos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
            'sort_orders' => 'nullable|array',
            'sort_orders.*' => 'nullable|integer',
            'remove_logo' => 'nullable|boolean',
            'remove_media' => 'nullable|array',
            'remove_media.*' => 'integer|exists:media,media_id',
        ]);

        $lembaga = LembagaDesa::findOrFail($id);
        $data = $request->except(['logos', 'captions', 'sort_orders', 'remove_media', 'remove_logo']);

        // Handle single logo removal
        if ($request->has('remove_logo') && $lembaga->logo) {
            Storage::delete('public/logos/' . $lembaga->logo);
            $data['logo'] = null;
        }

        // Upload new single logo untuk backward compatibility
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($lembaga->logo) {
                Storage::delete('public/logos/' . $lembaga->logo);
            }
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . Str::slug($request->nama_lembaga) . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->storeAs('public/logos', $logoName);
            $data['logo'] = $logoName;
        }

        // Remove selected media
        if ($request->has('remove_media')) {
            foreach ($request->remove_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->ref_table == 'lembaga_desa' && $media->ref_id == $lembaga->lembaga_id) {
                    // Hapus file dari storage
                    Storage::delete('public/uploads/' . $media->file_name);
                    // Hapus dari database
                    $media->delete();
                }
            }
        }

        // Update captions and sort orders for existing media
        if ($request->has('captions')) {
            foreach ($request->captions as $mediaId => $caption) {
                $media = Media::find($mediaId);
                if ($media && $media->ref_table == 'lembaga_desa' && $media->ref_id == $lembaga->lembaga_id) {
                    $media->update([
                        'caption' => $caption,
                        'sort_order' => $request->sort_orders[$mediaId] ?? $media->sort_order,
                    ]);
                }
            }
        }

        // Upload new multiple logos
        if ($request->hasFile('logos')) {
            $counter = $lembaga->media()->count() + 1;
            foreach ($request->file('logos') as $index => $logo) {
                $fileName = 'lembaga_' . $lembaga->lembaga_id . '_' . time() . '_' . $index . '.' . $logo->getClientOriginalExtension();
                $path = $logo->storeAs('public/uploads', $fileName);

                Media::create([
                    'ref_table' => 'lembaga_desa',
                    'ref_id' => $lembaga->lembaga_id,
                    'file_name' => $fileName,
                    'caption' => $request->captions_new[$index] ?? null,
                    'mime_type' => $logo->getMimeType(),
                    'sort_order' => $request->sort_orders_new[$index] ?? $counter++,
                ]);
            }
        }

        $lembaga->update($data);

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lembaga = LembagaDesa::findOrFail($id);

        // Hapus single logo (backward compatibility)
        if ($lembaga->logo) {
            Storage::delete('public/logos/' . $lembaga->logo);
        }

        // Hapus semua media terkait
        foreach ($lembaga->media as $media) {
            Storage::delete('public/uploads/' . $media->file_name);
            $media->delete();
        }

        $lembaga->delete();

        return redirect()->route('lembaga.index')
            ->with('success', 'Lembaga desa berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Menampilkan daftar semua media.
     */
    public function index()
    {
        $media = Media::orderBy('media_id', 'desc')->paginate(10);
        return view('pages.media.index', compact('media'));
    }

    /**
     * Menampilkan form untuk membuat media baru.
     */
    public function create()
    {
        return view('pages.media.create');
    }

    /**
     * Menyimpan media baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'file_upload' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        // Proses upload file
        $file = $request->file('file_upload');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Simpan file ke storage
        $path = $file->storeAs('public/uploads', $fileName);

        // Simpan ke database
        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'file_name' => $fileName,
            'caption' => $request->caption,
            'mime_type' => $file->getMimeType(),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil disimpan.');
    }

    /**
     * Menampilkan detail media.
     */
    public function show(Media $media)
    {
        return view('pages.media.show', compact('media'));
    }

    /**
     * Menampilkan form untuk mengedit media.
     */
    public function edit(Media $media)
    {
        return view('pages.media.edit', compact('media'));
    }

    /**
     * Memperbarui media.
     */
    public function update(Request $request, Media $media)
    {
        // Validasi input
        $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        // Data yang akan diupdate
        $data = [
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'caption' => $request->caption,
            'sort_order' => $request->sort_order,
        ];

        // Jika ada file baru diupload
        if ($request->hasFile('file_upload')) {
            foreach ($request->file('file_upload') as $file){{
                // Hapus file lama
            Storage::delete('public/uploads/' . $media->file_name);

            // Upload file baru
            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $fileName);

            $data['file_name'] = $fileName;
            $data['mime_type'] = $file->getMimeType();
            }}

        }

        // Update database
        $media->update($data);

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil diperbarui.');
    }

    /**
     * Menghapus media.
     */
    public function destroy(Media $media)
    {
        try {
            // Hapus file dari storage
            Storage::delete('public/uploads/' . $media->file_name);

            // Hapus dari database
            $media->delete();

            return redirect()->route('media.index')
                ->with('success', 'Media berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('media.index')
                ->with('error', 'Gagal menghapus media.');
        }
    }
}

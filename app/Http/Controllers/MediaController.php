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
        // Mengurutkan dari yang terbaru
        $media = Media::orderBy('media_id', 'desc')->paginate(9);
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
        // 1. Validasi input
        $request->validate([
            'ref_table'   => 'required|string|max:50',
            'ref_id'      => 'required|integer',
            'file_upload' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Max 2MB
            'caption'     => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
        ]);

        // 2. Proses upload file
        $file = $request->file('file_upload');
        // Membuat nama file unik: timestamp_namafileasli
        $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

        // 3. Simpan file ke storage (storage/app/public/uploads)
        $file->storeAs('public/uploads', $fileName);

        // 4. Simpan data ke database
        Media::create([
            'ref_table'  => $request->ref_table,
            'ref_id'     => $request->ref_id,
            'file_name'  => $fileName,
            'caption'    => $request->caption,
            'mime_type'  => $file->getMimeType(),
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
        // 1. Validasi input (file_upload menjadi nullable/opsional di sini)
        $request->validate([
            'ref_table'   => 'required|string|max:50',
            'ref_id'      => 'required|integer',
            'caption'     => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        // 2. Siapkan data yang akan diupdate (selain file)
        $data = [
            'ref_table'  => $request->ref_table,
            'ref_id'     => $request->ref_id,
            'caption'    => $request->caption,
            'sort_order' => $request->sort_order,
        ];

        // 3. Cek apakah user mengupload file baru?
        if ($request->hasFile('file_upload')) {

            // Hapus file lama jika ada di storage
            $oldFilePath = 'public/uploads/' . $media->file_name;
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }

            // Proses upload file baru
            $file = $request->file('file_upload');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/uploads', $fileName);

            // Masukkan info file baru ke array data
            $data['file_name'] = $fileName;
            $data['mime_type'] = $file->getMimeType();
        }

        // 4. Update database
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
            // 1. Hapus file fisik dari storage
            $filePath = 'public/uploads/' . $media->file_name;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // 2. Hapus record dari database
            $media->delete();

            return redirect()->route('media.index')
                ->with('success', 'Media berhasil dihapus.');

        } catch (\Exception $e) {
            // Log error jika diperlukan: \Log::error($e->getMessage());
            return redirect()->route('media.index')
                ->with('error', 'Gagal menghapus media.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media; // Pastikan menggunakan Model Media
use Illuminate\Support\Facades\Storage; // Untuk operasi file

class MediaController extends Controller
{
    /**
     * Menampilkan daftar semua media.
     */
    public function index()
    {
        // Ambil semua data media, urutkan berdasarkan ID terbaru
        $media = Media::orderByDesc('media_id')->paginate(10);

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
     * Menyimpan media yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'caption' => 'nullable|string|max:255',
            'file_upload' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048', // Contoh validasi file
        ]);

        // 2. Proses upload file
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Simpan file ke direktori 'public/uploads/media'
            $path = $file->storeAs('public/uploads/media', $fileName);
            $mimeType = $file->getMimeType();
        } else {
            return redirect()->back()->withErrors(['file_upload' => 'File tidak ditemukan.']);
        }

        // 3. Simpan data ke database
        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'file_name' => $fileName,
            'caption' => $request->caption,
            'mime_type' => $mimeType,
            'sort_order' => $request->sort_order ?? 0, // Beri nilai default 0 jika kosong
        ]);

        return redirect()->route('media.index')
                         ->with('success', 'Media berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail media tertentu (tidak terlalu umum untuk media, tapi disertakan).
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
     * Memperbarui media tertentu di database.
     */
    public function update(Request $request, Media $media)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048', // File opsional saat update
        ]);

        $dataToUpdate = [
            'caption' => $request->caption,
            'sort_order' => $request->sort_order,
        ];

        // 2. Proses upload/update file (jika ada file baru)
        if ($request->hasFile('file_upload')) {
            // Hapus file lama jika ada
            Storage::delete('public/uploads/media/' . $media->file_name);

            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads/media', $fileName);
            $mimeType = $file->getMimeType();

            $dataToUpdate['file_name'] = $fileName;
            $dataToUpdate['mime_type'] = $mimeType;
        }

        // 3. Update data di database
        $media->update($dataToUpdate);

        return redirect()->route('media.index')
                         ->with('success', 'Media berhasil diperbarui.');
    }

    /**
     * Menghapus media tertentu dari database.
     */
    public function destroy(Media $media)
    {
        // 1. Hapus file fisik dari storage
        Storage::delete('public/uploads/media/' . $media->file_name);

        // 2. Hapus data dari database
        $media->delete();

        return redirect()->route('media.index')
                         ->with('success', 'Media berhasil dihapus.');
    }
}   

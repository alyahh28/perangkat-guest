<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Media::query();

        // Filter berdasarkan tabel referensi
        if ($request->has('ref_table')) {
            $query->where('ref_table', $request->ref_table);
        }

        // Filter berdasarkan ID referensi
        if ($request->has('ref_id')) {
            $query->where('ref_id', $request->ref_id);
        }

        // Urutkan berdasarkan sort_order
        $query->orderBy('sort_order', 'asc');

        $media = $query->get();

        return response()->json([
            'success' => true,
            'data' => $media,
            'message' => 'Data media berhasil diambil'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ref_table' => 'required|string|max:100',
            'ref_id' => 'required|integer',
            'file' => 'required|file|max:10240', // Max 10MB
            'caption' => 'nullable|string',
            'mime_type' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('media', $fileName, 'public');

            $media = Media::create([
                'ref_table' => $request->ref_table,
                'ref_id' => $request->ref_id,
                'file_name' => $fileName,
                'caption' => $request->caption,
                'mime_type' => $request->mime_type,
                'sort_order' => $request->sort_order ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'data' => $media,
                'message' => 'Media berhasil disimpan'
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'File tidak ditemukan'
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $media,
            'message' => 'Media berhasil diambil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'caption' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        $media->update([
            'caption' => $request->caption ?? $media->caption,
            'sort_order' => $request->sort_order ?? $media->sort_order,
        ]);

        return response()->json([
            'success' => true,
            'data' => $media,
            'message' => 'Media berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        // Hapus file dari storage
        Storage::disk('public')->delete('media/' . $media->file_name);

        // Hapus record dari database
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus'
        ]);
    }

    /**
     * Update sort order multiple media
     */
    public function updateSortOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'media' => 'required|array',
            'media.*.media_id' => 'required|integer',
            'media.*.sort_order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        foreach ($request->media as $item) {
            Media::where('media_id', $item['media_id'])
                ->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan media berhasil diupdate'
        ]);
    }

    /**
     * Get media by reference
     */
    public function getByReference($table, $id)
    {
        $media = Media::byReference($table, $id)
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $media,
            'message' => 'Media berdasarkan referensi berhasil diambil'
        ]);
    }
}

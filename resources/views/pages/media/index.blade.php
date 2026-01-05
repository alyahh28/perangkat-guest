@extends('layouts.guest.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Media</h2>
        <a href="{{ route('media.create') }}" class="btn btn-primary">Tambah Media Baru</a>
    </div>

    {{-- Menampilkan pesan sukses/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Preview</th>
                        <th>Nama File</th>
                        <th>Ref Table</th>
                        <th>Ref ID</th>
                        <th>Caption</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($media as $item)
                    <tr>
                        <td>{{ $loop->iteration + $media->firstItem() - 1 }}</td>
                        <td>
                            @if(str_contains($item->mime_type, 'image'))
                                <img src="{{ $item->url }}" alt="{{ $item->caption }}" style="height: 50px; width: auto; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">{{ $item->mime_type }}</span>
                            @endif
                        </td>
                        <td>{{ $item->file_name }}</td>
                        <td>{{ $item->ref_table }}</td>
                        <td>{{ $item->ref_id }}</td>
                        <td>{{ $item->caption ?? '-' }}</td>
                        <td>
                            <a href="{{ route('media.edit', $item->media_id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('media.destroy', $item->media_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus media ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data media.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $media->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

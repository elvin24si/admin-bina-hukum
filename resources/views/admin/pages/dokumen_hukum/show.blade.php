@extends('layouts.admin.app')

@section('title', 'Detail Dokumen Hukum')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Detail Dokumen --}}
    <div class="bg-light rounded p-4 mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5>Detail Dokumen Hukum</h5>
            <a href="{{ route('dokumen_hukum.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

        <table class="table table-borderless">
            <tr>
                <th width="200">Nomor</th>
                <td>{{ $dokumen->nomor }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $dokumen->judul }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td>{{ $dokumen->jenis?->nama_jenis ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $dokumen->kategori?->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $dokumen->tanggal ? date('d M Y', strtotime($dokumen->tanggal)) : '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-primary">
                        {{ $dokumen->status }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Ringkasan</th>
                <td>{{ $dokumen->ringkasan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- Upload Lampiran --}}
    <div class="bg-light rounded p-4 mb-4">
        <h6 class="mb-3">Upload Lampiran</h6>

        <form action="{{ route('dokumen_hukum.lampiran.upload', $dokumen->dokumen_id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="ref_id" value="{{ $dokumen->dokumen_id }}">

            <div class="mb-3">
                <input type="file" name="files[]" class="form-control" multiple required>
            </div>

            <button class="btn btn-primary btn-sm">
                Upload Lampiran
            </button>
        </form>
    </div>

    {{-- List Lampiran --}}
    <div class="bg-light rounded p-4">
        <h6 class="mb-3">Lampiran Dokumen</h6>

        @if ($files->isEmpty())
            <p class="text-muted mb-0">Belum ada lampiran.</p>
        @else
            <ul class="list-group">
                @foreach ($files as $file)
                    <li class="list-group-item d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            @if (str_starts_with($file->mime_type, 'image/'))
                                <img src="{{ asset('storage/dokumen_hukum/' . $file->file_name) }}"
                                     width="60"
                                     class="img-thumbnail me-3">
                            @endif

                            <a href="{{ asset('storage/dokumen_hukum/' . $file->file_name) }}"
                               target="_blank">
                                {{ $file->caption }}
                            </a>
                        </div>

                        <form action="{{ route('dokumen_hukum.lampiran.delete', $file->media_id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Hapus lampiran ini?')">
                                Hapus
                            </button>
                        </form>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection

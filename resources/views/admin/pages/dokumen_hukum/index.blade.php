@extends('layouts.admin.app')
@section('title', 'Data Dokumen Hukum')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Dokumen Hukum</h6>
                <a href="{{ route('dokumen_hukum.create') }}" class="btn btn-primary btn-sm">
                    + Tambah Dokumen Hukum
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nomor</th>
                            <th class="border-0">Judul</th>
                            <th class="border-0">Jenis</th>
                            <th class="border-0">Kategori</th>
                            <th class="border-0">Tanggal</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Ringkasan</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataDokumenHukum as $item)
                            <tr>
                                <td>{{ $item->nomor }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->jenis?->nama_jenis ?? '-' }}</td>
                                <td>{{ $item->kategori?->nama ?? '-' }}</td>
                                <td>{{ $item->tanggal ? date('d M Y', strtotime($item->tanggal)) : '-' }}</td>
                                <td>{{ $item->status }}</td>

                                <td>
                                    <button class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="modal" data-bs-target="#ringkasanModal{{ $item->dokumen_id }}">
                                        Lihat
                                    </button>

                                    <div class="modal fade" id="ringkasanModal{{ $item->dokumen_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ringkasan Dokumen</h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    {{ $item->ringkasan ?? 'Tidak ada ringkasan.' }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td class="text-center">

                                    <a href="{{ route('dokumen_hukum.edit', $item->dokumen_id) }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('dokumen_hukum.destroy', $item->dokumen_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Yakin ingin menghapus dokumen ini?')">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

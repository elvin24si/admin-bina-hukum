@extends('layouts.admin.app')
@section('title', 'Data Kategori Dokumen')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Kategori Dokumen</h6>
                <a href="{{ route('kategori_dokumen.create') }}" class="btn btn-primary btn-sm">
                    + Tambah Kategori Dokumen
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nama Kategori</th>
                            <th class="border-0">Deskripsi</th>
                            <th class="border-0">Created</th>
                            <th class="border-0">Last Updated</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataKategoriDokumen as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>{{ $item->created_at?->format('d M Y H:i') ?? '-' }}</td>
                                <td>{{ $item->updated_at?->format('d M Y H:i') ?? '-' }}</td>

                                <td class="text-center">

                                    <a href="{{ route('kategori_dokumen.edit', $item->kategori_id) }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('kategori_dokumen.destroy', $item->kategori_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>

                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#descModal{{ $item->kategori_id }}">
                                        <i class="bi bi-eye me-1"></i> Lihat
                                    </button>

                                    <div class="modal fade" id="descModal{{ $item->kategori_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Deskripsi Lengkap</h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    {{ $item->deskripsi }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

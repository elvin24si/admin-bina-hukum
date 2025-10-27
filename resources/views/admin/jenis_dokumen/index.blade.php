@extends('layouts.admin.app')
@section('title', 'Data Jenis Dokumen')
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
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Jenis Dokumen</h6>
                <div>
                    <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary btn-sm">
                        + Tambah Jenis Dokumen
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="table-jenis-dokumen" class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nama Jenis</th>
                            <th class="border-0">Deskripsi</th>
                            <th class="border-0">Created</th>
                            <th class="border-0">Last Updated</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataJenisDokumen as $item)
                            <tr>
                                <td>{{ $item->nama_jenis }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                                <td>{{ $item->updated_at ? $item->updated_at->format('d M Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('jenis_dokumen.edit', $item->jenis_id) }}"
                                        class="btn btn-sm btn-outline-primary me-2 d-inline-flex align-items-center">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('jenis_dokumen.destroy', $item->jenis_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
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

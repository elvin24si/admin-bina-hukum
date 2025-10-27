@extends('layouts.admin.app')
@section('title', 'Data Warga')
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
                <h6 class="mb-0">Data Warga</h6>
                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                    + Tambah Warga
                </a>
            </div>

            <div class="table-responsive">
                <table id="table-warga" class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">No. KTP</th>
                            <th class="border-0">Nama</th>
                            <th class="border-0">Jenis Kelamin</th>
                            <th class="border-0">Agama</th>
                            <th class="border-0">Pekerjaan</th>
                            <th class="border-0">Telp</th>
                            <th class="border-0">Email</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataWarga as $item)
                            <tr>
                                <td>{{ $item->no_ktp }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->pekerjaan ?? '-' }}</td>
                                <td>{{ $item->telp ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                        class="btn btn-sm btn-outline-primary me-2 d-inline-flex align-items-center">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
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

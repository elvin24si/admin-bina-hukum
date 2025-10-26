@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Data Warga Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Warga</h6>
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
                            <th class="border-0 rounded-end">Email</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Data Warga End -->

    <!-- Jenis Dokumen Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Jenis Dokumen</h6>
            </div>
            <div class="table-responsive">
                <table id="table-jenis-dokumen" class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nama Jenis</th>
                            <th class="border-0">Deskripsi</th>
                            <th class="border-0">Created</th>
                            <th class="border-0 rounded-end">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataJenisDokumen as $item)
                            <tr>
                                <td>{{ $item->nama_jenis }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                                <td>{{ $item->updated_at ? $item->updated_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Jenis Dokumen End -->
@endsection

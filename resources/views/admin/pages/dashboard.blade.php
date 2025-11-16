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
                                <td>
                                    @if ($item->jenis_kelamin === 'Laki-laki')
                                        <span class="badge rounded-pill px-3 py-2 text-white"
                                            style="background-color: #2196f3;">
                                            {{ $item->jenis_kelamin }}
                                        </span>
                                    @elseif ($item->jenis_kelamin === 'Perempuan')
                                        <span class="badge rounded-pill px-3 py-2 text-dark"
                                            style="background-color: #ff7a87;">
                                            {{ $item->jenis_kelamin }}
                                        </span>
                                    @endif
                                </td>
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

    <!-- Dokumen Hukum Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Dokumen Hukum</h6>
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
                            <th class="border-0 rounded-end">Ringkasan</th>
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
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#ringkasanModal{{ $item->dokumen_id }}">
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
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Jenis Dokumen End -->
@endsection

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
                <form method="GET" action="{{ route('dokumen_hukum.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="Revisi" {{ request('status') == 'Revisi' ? 'selected' : '' }}>
                                    Revisi</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Search">
                                <button type="submit" class="input-group-text" id="basic-addon2">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nomor</th>
                            <th class="border-0">Judul</th>
                            <th class="border-0">Jenis</th>
                            <th class="border-0">Kategori</th>
                            <th class="border-0">Tanggal</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Lampiran</th>
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
                                <td>
                                    @if ($item->status === 'Aktif')
                                        <span class="badge rounded-pill px-3 py-2 text-white"
                                            style="background-color: #0cb200;">
                                            {{ $item->status }}
                                        </span>
                                    @elseif ($item->status === 'Tidak Aktif')
                                        <span class="badge rounded-pill px-3 py-2 text-white"
                                            style="background-color: #d40000;">
                                            {{ $item->status }}
                                        </span>
                                    @elseif ($item->status === 'Draft')
                                        <span class="badge rounded-pill px-3 py-2 text-white"
                                            style="background-color: #5221f3;">
                                            {{ $item->status }}
                                        </span>
                                    @elseif ($item->status === 'Revisi')
                                        <span class="badge rounded-pill px-3 py-2 text-white"
                                            style="background-color: #d4ca00;">
                                            {{ $item->status }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('dokumen_hukum.show', $item->dokumen_id) }}"
                                        class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bi bi-paperclip me-1"></i> Detail
                                    </a>
                                </td>

                                <td class="text-center">

    <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal"
        data-bs-target="#ringkasanModal{{ $item->dokumen_id }}">
        Ringkasan
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

    <a href="{{ route('dokumen_hukum.edit', $item->dokumen_id) }}"
        class="btn btn-sm btn-outline-primary me-2">
        <i class="bi bi-pencil-square me-1"></i> Edit
    </a>

    <form action="{{ route('dokumen_hukum.destroy', $item->dokumen_id) }}" method="POST"
        class="d-inline">
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
                <div class="mt-3">
                    {{ $dataDokumenHukum->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

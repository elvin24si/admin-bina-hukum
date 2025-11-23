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
                <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
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
                <div class="mt-3">
                    {{ $dataWarga->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

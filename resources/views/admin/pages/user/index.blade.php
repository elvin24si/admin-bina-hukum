@extends('layouts.admin.app')
@section('title', 'Data User')
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
                <h6 class="mb-0">Data User</h6>
                <div>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        + Tambah User
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                    <div class="row">
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
                <table id="table-jenis-dokumen" class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Profile</th>
                            <th class="border-0">Nama</th>
                            <th class="border-0">Email</th>
                            <th class="border-0">Password</th>>
                            <th class="border-0">Role</th>>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $item)
                            <tr>
                                <td>
                                    @if ($item->profile_picture)
                                        <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                        alt="Profile Picture" class="rounded-circle" width="50" height="50">
                                    @else
                                        <img src="{{ asset('img/User_Placeholder.png') }}" alt="Default Profile Picture"
                                            class="rounded-circle" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->role }}</td>
                                <td class="text-center">
                                    <a href="{{ route('user.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-primary me-2 d-inline-flex align-items-center">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
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
                    {{ $dataUser->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

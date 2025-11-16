@extends('layouts.admin.app')
@section('title', 'Edit Kategori Dokumen')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Edit Kategori Dokumen</h6>
                <a href="{{ route('kategori_dokumen.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori_dokumen.update', $kategoriDokumen->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 text-start">
                    <label for="nama" class="form-label">
                        Nama Kategori <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" class="form-control"
                        placeholder="Masukkan nama kategori"
                        value="{{ old('nama', $kategoriDokumen->nama) }}" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="deskripsi" class="form-label">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $kategoriDokumen->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kategori_dokumen.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>

        </div>
    </div>
@endsection

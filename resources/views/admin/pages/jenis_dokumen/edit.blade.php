@extends('layouts.admin.app')
@section('title', 'Edit Jenis Dokumen')
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
                <h6 class="mb-0">Edit Jenis Dokumen</h6>
                <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>
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

            <form action="{{ route('jenis_dokumen.update', $jenisDokumen->jenis_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 text-start">
                    <label for="nama_jenis" class="form-label">Nama Jenis <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                        placeholder="Masukkan nama jenis dokumen (Tidak boleh sama)"
                        value="{{ old('nama_jenis', $jenisDokumen->nama_jenis) }}" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                        placeholder="Deskripsi singkat tentang jenis dokumen" required>{{ old('deskripsi', $jenisDokumen->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
@endsection

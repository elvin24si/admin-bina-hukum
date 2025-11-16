@extends('layouts.admin.app')
@section('title', 'Edit Dokumen Hukum')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Edit Dokumen Hukum</h6>
                <a href="{{ route('dokumen_hukum.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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

            <form action="{{ route('dokumen_hukum.update', $dokumen->dokumen_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 text-start">
                    <label class="form-label">Nomor Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="nomor" class="form-control"
                        value="{{ old('nomor', $dokumen->nomor) }}" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control"
                        value="{{ old('judul', $dokumen->judul) }}" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                    <select class="form-select" name="jenis_id" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach ($listJenis as $jenis)
                            <option value="{{ $jenis->jenis_id }}"
                                {{ old('jenis_id', $dokumen->jenis_id) == $jenis->jenis_id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Kategori Dokumen <span class="text-danger">*</span></label>
                    <select class="form-select" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($listKategori as $kategori)
                            <option value="{{ $kategori->kategori_id }}"
                                {{ old('kategori_id', $dokumen->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Tanggal Dokumen</label>
                    <input type="date" name="tanggal" class="form-control"
                        value="{{ old('tanggal', $dokumen->tanggal) }}">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <input type="text" name="status" class="form-control"
                        value="{{ old('status', $dokumen->status) }}" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="4">{{ old('ringkasan', $dokumen->ringkasan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('dokumen_hukum.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>

            </form>

        </div>
    </div>
@endsection

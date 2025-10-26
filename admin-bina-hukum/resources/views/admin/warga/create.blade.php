@extends('layouts.admin.app')
@section('title', 'Tambah Data Warga')
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
                <h6 class="mb-0">Tambah Data Warga</h6>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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

            <form action="{{ route('warga.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3 text-start">
                        <label for="no_ktp" class="form-label">No. KTP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                            placeholder="Masukkan nomor KTP" value="{{ old('no_ktp') }}" required>
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" disabled selected>--Pilih jenis kelamin--</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama"
                            placeholder="Masukkan agama" value="{{ old('agama') }}" required>
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                            placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}">
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp"
                            placeholder="Masukkan nomor telepon" value="{{ old('telp') }}">
                    </div>

                    <div class="col-md-12 mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan alamat email" value="{{ old('email') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
@endsection

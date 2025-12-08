@extends('layouts.admin.app')
@section('title', 'Edit Data User')
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
                <h6 class="mb-0">Edit Data User</h6>
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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

            <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $dataUser->name) }}" placeholder="Masukkan Nama User" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $dataUser->email) }}" placeholder="Enter email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukkan Password Baru" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi Password Baru">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role', $dataUser->role ?? '') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="viewer" {{ old('role', $dataUser->role ?? '') == 'viewer' ? 'selected' : '' }}>
                            Viewer
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="profile_picture">Foto Profil (Opsional)</label>
                    <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                        id="profile_picture" name="profile_picture" accept="image/*">

                    @error('profile_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Current Profile Picture -->
                    <div class="mt-3">
                        @if ($dataUser->profile_picture)
                            <p>Foto Profil Saat Ini:</p>
                            <img src="{{ asset('storage/' . $dataUser->profile_picture) }}" alt="Profile Picture"
                                width="120" class="img-thumbnail mb-2">
                        @else
                            <p class="text-muted">Belum ada foto profil</p>
                        @endif
                    </div>

                    <!-- Preview New Upload -->
                    <p>Foto Profil Baru:</p>
                    <div class="mt-3">
                        <img id="previewImage" src="#" alt="Preview Gambar" class="img-thumbnail d-none"
                            width="120">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>

            <!-- Preview Script -->
            <script>
                document.getElementById('profile_picture').onchange = evt => {
                    const [file] = evt.target.files;
                    if (file) {
                        const img = document.getElementById('previewImage');
                        img.src = URL.createObjectURL(file);
                        img.classList.remove('d-none');
                    }
                }
            </script>
        </div>
    </div>
@endsection

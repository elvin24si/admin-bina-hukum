<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-file-alt me-2"></i>BINA DESA</h3>
        </a>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link">
                <i class="fa fa-home me-2"></i> Dashboard
            </a>
            <a href="{{ route('warga.index') }}" class="nav-item nav-link">
                <i class="fa fa-users me-2"></i> Data Warga
            </a>
            <a href="{{ route('jenis_dokumen.index') }}" class="nav-item nav-link">
                <i class="fa fa-file-alt me-2"></i> Jenis Dokumen
            </a>
            <a href="{{ route('user.index') }}" class="nav-item nav-link">
                <i class="fa fa-users me-2"></i> Data User
            </a>
            <div class="d-flex justify-content-center">
            <a href="/" class="btn btn-danger ms-3 mb-3">
                <i class="fa fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
        </div>
    </nav>
</div>

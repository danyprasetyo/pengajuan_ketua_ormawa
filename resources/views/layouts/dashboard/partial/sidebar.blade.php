<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard.') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @can('admin')
                <div class="sb-sidenav-menu-heading">Master Data</div>
                <a class="nav-link" href="{{ route('dashboard.ormawa.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-sitemap"></i></div>
                    Ormawa
                </a>
                <a class="nav-link" href="{{ route('dashboard.periode.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-tree"></i></div>
                    Periode
                </a>
                <a class="nav-link" href="{{ route('dashboard.buat_akun.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Kelola Akun Pendaftar
                </a>
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Pengajuan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('dashboard.pengajuan.pending')}}">Konfirmasi</a>
                        <a class="nav-link" href="{{route('dashboard.pengajuan.diterima')}}">Diterima</a>
                        <a class="nav-link" href="{{route('dashboard.pengajuan.ditolak')}}">Ditolak</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setting" aria-expanded="false" aria-controls="setting">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="setting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('dashboard.persyaratan.index')}}">Persyaratan</a>
                    </nav>
                </div>
                @endcan
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->username }}
        </div>
    </nav>
</div>

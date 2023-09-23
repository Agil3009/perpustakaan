<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @if(auth()->user()->role=='Admin')
                <a class="nav-link" href="{{route('pengguna.list')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Manajemen Pengguna
                </a>
                <a class="nav-link" href="{{route('buku.list')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Manajemen Buku
                </a>
                <a class="nav-link" href="{{route('kategori.list')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Manajemen Katagori
                </a>
                @endif
                <a class="nav-link" href="{{route('pinjam.list')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Pinjam Buku
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
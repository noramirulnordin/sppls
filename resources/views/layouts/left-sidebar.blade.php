<!-- Professional & Modern Sidebar Design -->

<div class="leftside-menu bg-dark text-light shadow-lg">

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-light mt-3 mb-4 d-block">
        <span class="logo-lg">
            <img src="/assets/images/logo-lg.png" alt="Logo" height="48" class="mx-auto d-block">
        </span>
        <span class="logo-sm d-none">
            <img src="/assets/images/logo.png" alt="Logo Small" height="28" class="mx-auto">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav list-unstyled mb-0">

            <!-- MAIN -->
            <li class="side-nav-item mt-4">
                <a href="/" class="side-nav-link d-flex align-items-center">
                    <i class="uil-home-alt fs-5 me-2"></i>
                    <span class="fw-semibold">Halaman Utama</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="my-3">
                <hr class="sidebar-divider bg-light opacity-25 m-0">
            </li>

            <!-- MENU SECTION -->
            <li class="side-nav-title side-nav-item text-uppercase small text-secondary fw-bold ps-2 mb-1">Menu</li>

            @if (auth()->user()->is_admin)
                <li class="side-nav-item">
                    <a href="{{ route('users.index') }}" class="side-nav-link d-flex align-items-center">
                        <i class="uil-user fs-5 me-2"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
            @endif

            <li class="side-nav-item">
                <a href="{{ route('balaks.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="uil-trees fs-5 me-2"></i>
                    <span>Balak</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('pembelis.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="uil-users-alt fs-5 me-2"></i>
                    <span>Pembeli</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('resits.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="uil-receipt fs-5 me-2"></i>
                    <span>Resit</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('transaksis.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="mdi mdi-cart fs-5 me-2"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('loris.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="mdi mdi-truck fs-5 me-2"></i>
                    <span>Lori</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('kawasans.index') }}" class="side-nav-link d-flex align-items-center">
                    <i class="mdi mdi-map fs-5 me-2"></i>
                    <span>Kawasan</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="my-3">
                <hr class="sidebar-divider bg-light opacity-25 m-0">
            </li>

            <!-- ACTION SECTION -->
            <li class="side-nav-title side-nav-item text-uppercase small text-secondary fw-bold ps-2 mb-1">Tindakan</li>

            <li class="side-nav-item">
                <a href="{{ route('transaksis.create') }}" class="side-nav-link d-flex align-items-center">
                    <i class="mdi mdi-cart-plus fs-5 me-2"></i>
                    <span>Buat Pembelian</span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>

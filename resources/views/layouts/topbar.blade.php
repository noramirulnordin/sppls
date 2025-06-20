<div class="navbar-custom navbar-custom d-flex align-items-center">
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>

    <div class="d-flex align-items-center ms-3 h-100 flex-grow-1">
        <span class="fw-bold fs-5 text-uppercase my-auto">
            SISTEM PENGURUSAN PEMBALAKAN &amp; LIGA SEPAKAT
        </span>
    </div>
    <ul class="list-unstyled topbar-menu mb-0 ms-auto">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ auth()->user()->profile_image ?? asset('assets/images/no_profile_image.png') }}"
                        alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position">Admin</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selam Sejahtera!</h6>
                </div>

                <!-- item-->
                <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>Profil Saya</span>
                </a>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"
                    class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Log Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>

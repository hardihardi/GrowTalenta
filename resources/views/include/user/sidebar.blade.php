<style>
    aside#sidenav-main {
        height: 100vh;
        /* Menyesuaikan tinggi dengan layar */
        overflow-y: auto;
        /* Menambahkan scroll jika kontennya panjang */
        position: fixed;
        /* Memastikan navbar tetap berada di sisi kiri */
        top: 0;
        /* Mulai dari atas layar */
        left: 0;
        /* Mulai dari sisi kiri layar */
        width: 250px;
        /* Atur lebar sidebar sesuai kebutuhan */
        background-color: #fff;
        /* Warna background */
        z-index: 1030;
        /* Menyesuaikan posisi dengan elemen lainnya */
    }

    .nav-item.active .nav-link {
        background-color: #f5f5f5;
        color: #5e72e4;
        font-weight: bold;
    }

    /* Transition effects for smooth experience */
    .nav-item .nav-link {
        position: relative;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .nav-link:hover .icon {
        color: #5e72e4;
    }
</style>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src={{ asset('admin/assets/img/logo/logo.png') }} alt="Logo" class="app-brand-logo"
                style="max-width: 100%; height: auto;">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main" style="min-height: 100%;">
        <ul class="navbar-nav">
            <!-- Dashboard Menu -->
            <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Table</h6>
            </li>

            <!-- Absensi Menu -->
            <li class="nav-item {{ request()->is('user/absensi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/absensi') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Absensi</span>
                </a>
            </li>

            <!-- New Izin Sakit Menu Item -->
            {{-- <li class="nav-item {{ request()->routeIs('izin.sakit') ? 'active' : '' }}">
                <a href="{{ route('izin.sakit') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                    <div data-i18n="Izin Sakit">Izin Sakit</div>

                    <!-- Notification Badge for Pending Sakit Permits -->
                    <span class="badge badge-center rounded-pill bg-danger ms-2">
                        {{ $izin_sakit_count ?? 0 }}
                    </span>
                </a>
            </li> --}}
            <li class="nav-item {{ request()->routeIs('izin.sakit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('izin.sakit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-plus-medical text-success text-sm opacity-10"></i>
                    </div>
                    <!-- Notification Badge for Pending Sakit Permits -->
                    <span class="nav-link-text ms-1">Izin sakit</span>
                    <span class="badge badge-center rounded-pill bg-danger ms-2">
                        {{ $izinSakitCount ?? 0 }}
                    </span>
                </a>
            </li>


            <!-- Billing Menu -->
            <li class="nav-item {{ request()->is('user/penggajian') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/penggajian') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Penggajian</span>
                </a>
            </li>

            <!-- Cuti Menu -->
            <li class="nav-item {{ request()->is('user/cuti') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/cuti') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cuti</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account</h6>
            </li>

            <!-- Profile Menu -->
            <li class="nav-item {{ request()->is('user/profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            <!-- Logout Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-power text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>

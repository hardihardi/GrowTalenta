<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Human Resource</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ url()->current() == route('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Master</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('pegawai.*') || request()->routeIs('jabatan.*') ? 'active menu-open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tmenu-icon tf-icons bx bx-user-pin" class="menu-item "></i>
                <div data-i18n="Authentications">Management Karyawan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('pegawai.admin') ? 'active' : '' }}">
                    <a href="{{ route('pegawai.admin') }}" class="menu-link">
                        <div data-i18n="Basic">Akun Admin</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('jabatan.*') ? 'active' : '' }}">
                    <a href="{{ route('jabatan.index') }}" class="menu-link">
                        <div data-i18n="Basic">Jabatan</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->routeIs('pegawai.*') && !request()->routeIs('pegawai.admin') ? 'active' : '' }}">
                    <a href="{{ route('pegawai.index') }}" class="menu-link">
                        <div data-i18n="Basic">Pegawai</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ url()->current() == route('penggajian.index') ? 'active' : '' }}">
            <a href="{{ route('penggajian.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div data-i18n="Analytics">Penggajian</div>
            </a>
        </li>
        <li class="menu-item {{ url()->current() == route('rekrutmen.index') ? 'active' : '' }}">
            <a href="{{ route('rekrutmen.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Analytics">Rekrutmen</div>
            </a>
        </li>
        <li class="menu-item  {{ url()->current() == route('cuti.menu') ? 'active' : '' }}">
            <a href="{{ route('cuti.menu') }}" class="menu-link">
                <i class='menu-icon bx bx-user-check'></i>
                <div data-i18n="Analytics" style="display: flex; gap: 59px">
                    Aprove Cuti
                    <span id="notification-count" class="badge bg-danger">
                        {{ $cutiNotifications->count() }}
                    </span>
                </div>
            </a>
        </li>
        <li class="menu-item
                        {{ url()->current() == route('berkas.index') ? 'active' : '' }}">
            <a href="{{ route('berkas.index') }}" class="menu-link">
                <i class='menu-icon bx bx-paperclip'></i>
                <div data-i18n="Analytics">Berkas Pribadi</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu User</span>
        </li>

        <li
            class="menu-item {{ request()->routeIs('absensi.*') || request()->routeIs('cuti.index') ? 'active menu-open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tmenu-icon tf-icons bx bx-calendar" class="menu-item "></i>
                <div data-i18n="Authentications">Menu Absensi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                    <a href="{{ route('absensi.index') }}" class="menu-link">
                        <div data-i18n="Analytics">Absen</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('cuti.index') ? 'active' : '' }}">
                    <a href="{{ route('cuti.index') }}" class="menu-link">
                        <div data-i18n="Basic">Ajukan Cuti</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Laporan</span>
        </li>
        <li
            class="menu-item {{ request()->routeIs('laporan.*') || request()->routeIs('laporan.*') ? 'active menu-open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tmenu-icon tf-icons bx bxs-report" class="menu-item "></i>
                <div data-i18n="Authentications">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('laporan.pegawai') ? 'active' : '' }}">
                    <a href="{{ route('laporan.pegawai') }}" class="menu-link">
                        <div data-i18n="Basic">Laporan Pegawai</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('laporan.absensi') ? 'active' : '' }}">
                    <a href="{{ route('laporan.absensi') }}" class="menu-link">
                        <div data-i18n="Basic">Laporan Absen</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('laporan.cuti') ? 'active' : '' }}">
                    <a href="{{ route('laporan.cuti') }}" class="menu-link">
                        <div data-i18n="Basic">Laporan Cuti</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

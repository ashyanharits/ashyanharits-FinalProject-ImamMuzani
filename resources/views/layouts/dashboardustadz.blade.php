<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Ustadz' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/images/favicon.svg') }}" type="image/x-icon">

    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>

<body>
    <div id="app">

        {{-- SIDEBAR --}}
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboardustadz') }}">
                                <img src="{{ asset('/images/logoremove.png') }}" alt="Logo" style="height: 60px; width:auto;">
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-x bi-middle"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- MENU --}}
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Dashboard</li>

                        <li class="sidebar-item {{ request()->routeIs('dashboardustadz') ? 'active' : '' }}">
                            <a href="{{ route('dashboardustadz') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Beranda</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Menu Ustadz</li>

                        <li class="sidebar-item {{ request()->routeIs('ustadz.jadwal*') ? 'active' : '' }}">
                            <a href="{{ route('ustadz.jadwal') }}" class="sidebar-link">
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Jadwal Mengajar</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('ustadz.santri*') ? 'active' : '' }}">
                            <a href="{{ route('ustadz.santri') }}" class="sidebar-link">
                                <i class="bi bi-people-fill"></i>
                                <span>Data Santri</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('ustadz.hafalan*') ? 'active' : '' }}">
                            <a href="{{ route('ustadz.hafalan') }}" class="sidebar-link">
                                <i class="bi bi-book-half"></i>
                                <span>Input Hafalan</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('ustadz.laporan*') ? 'active' : '' }}">
                            <a href="{{ route('ustadz.laporan') }}" class="sidebar-link">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="sidebar-toggler btn x">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>

        {{-- MAIN AREA --}}
        <div id="main">

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- PAGE HEADING --}}
            <div class="page-heading">
                <h3>{{ $title ?? 'Dashboard Ustadz' }}</h3>
            </div>

            {{-- PAGE CONTENT --}}
            <div class="page-content">
                {{ $slot }}
            </div>

            {{-- FOOTER --}}
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>© {{ date('Y') }} Sistem Informasi Santri</p>
                    </div>
                    <div class="float-end">
                        <p>Developed by <span class="text-primary">Ashyan</span></p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('mazer/dist/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('mazer/dist/assets/js/main.js') }}"></script>

    @livewireScripts
    @yield('scripts')
</body>
</html>

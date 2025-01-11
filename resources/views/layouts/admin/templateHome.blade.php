<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>GrowTalenta</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://iili.io/2rOi5VR.th.png"
        class="rounded-circle" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Toast Untuk Success -->
    @if (session('success'))
        <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 fade show toast-custom" role="alert"
            aria-live="assertive" aria-atomic="true" id="toastSuccess">
            <div class="toast-header">
                <i class="bi bi-check-circle me-2"></i>
                <div class="me-auto fw-semibold">Success</div>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- BAGIAN SIDEBAR -->

            @include('include.admin.sidebar')

            <!-- / BAGIAN SIDEBAR -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- INI BAGIAN HEADER -->

                @include('include.admin.header')

                <!-- / INI BAGIAN HEADER -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Welcome Back
                                                    <b>{{ Auth::user()->nama_pegawai }}</b> 🎉
                                                </h5>
                                                <p class="mb-4">
                                                    Ini Adalah Halaman Utama <span class="fw-bold">Grow Talenta Management System.</span>
                                                    <br>
                                                    Silahkan Cek Menu Menu Disini Untuk Melihat Informasi Yang Tersedia.
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="col-sm-5
                                                        text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="assets/img/illustrations/man-with-laptop-light.png"
                                                    height="140" alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <small class="text-warning fw-semibold">
                                                            <i class='bx bxs-user-circle' style="font-size: 50px"></i>
                                                        </small>
                                                    </div>
                                                </div>
                                                <span>Pegawai</span>
                                                <div class="row pt-2">
                                                    <div class="col">
                                                        <h3 class="card-title text-nowrap">
                                                            {{ $totalPegawai }}
                                                        </h3>
                                                    </div>
                                                    <div class="col"><a href="{{ route('pegawai.index') }}"
                                                            class="btn btn-primary btn-sm">Lihat</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <small class="text-primary fw-semibold">
                                                            <i class='bx bxs-wallet' style="font-size: 50px"></i>
                                                        </small>
                                                    </div>
                                                </div>
                                                <span>Gaji Keseluruhan</span>
                                                <h3 class="card-title text-nowrap mb-1 mt-3">
                                                    {{ $totalPenggajian }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <!-- Di bawah ini adalah konten untuk pegawai dan gaji -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <small class="text-warning fw-semibold">
                                                    <i class='bx bxs-user-circle' style="font-size: 50px"></i>
                                                </small>
                                            </div>
                                        </div>
                                        <span>Pegawai</span>
                                        <div class="row pt-2">
                                            <div class="col">
                                                <h3 class="card-title text-nowrap">
                                                    {{ $totalPegawai }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('pegawai.index') }}" class="btn btn-primary btn-sm">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <small class="text-primary fw-semibold">
                                                    <i class='bx bxs-wallet' style="font-size: 50px"></i>
                                                </small>
                                            </div>
                                        </div>
                                        <span>Gaji Keseluruhan</span>
                                        <h3 class="card-title text-nowrap mb-1 mt-3">
                                            Rp. {{ number_format($totalPenggajian, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DIBAWAH INI ADALAH UNTUK BAHAN SELANJUTNYA --}}

                        {{-- CART --}}
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="myChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->

                    <!-- Footer -->
                    {{-- @include('include.admin.footer') --}}
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- UNTU TOAST 1.5 DETIK --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastSuccess = document.getElementById('toastSuccess');
            const toastError = document.getElementById('toastError');

            if (toastSuccess) {
                setTimeout(function() {
                    toastSuccess.classList.add('toast-hide');
                }, 2000);
            }

            if (toastError) {
                setTimeout(function() {
                    toastError.classList.add('toast-hide');
                }, 2000);
            }
        });
    </script>


    {{-- JS CART --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart 1
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Pengeluaran (Dalam bentuk juta)',
                    data: [30, 24, 15, 25, 18, 32],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart 2
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Pemasukan (Dalam bentuk juta)',
                    data: [28, 30, 33, 25, 28, 30],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>

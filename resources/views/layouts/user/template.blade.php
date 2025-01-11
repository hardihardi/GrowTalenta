<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('user/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('https://iili.io/2rOi5VR.th.png') }}">
    <title>
        Karyawan Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('user/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js')}}" crossorigin="anonymous"></script>
    <link href="{{ asset('user/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('user/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    {{-- calender --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .bg-primary {
            background-color: #0d6efd !important;
        }

        .text-white {
            color: #ffffff !important;
        }
        .dark-mode {
            background-color: #1a202c;
            color: #ffffff;
        }

        .dark-mode .card {
            background-color: #2d3748;
            color: #ffffff;
        }

        .dark-mode .navbar {
            background-color: #2d3748;
        }
    </style>


</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    {{-- awal sidebar --}}
    @include('include.user.sidebar')
    {{-- akhir sidebar --}}


    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('include.user.navbar')

        @yield('content')

        {{-- end calender --}}

        {{-- Footer --}}
        @include('include.user.footer')
        {{-- / Footer --}}
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            {{-- <i class="fa fa-cog py-2"> </i> --}}
            <i class='bx bxs-cog py-2'></i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Argon Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                        onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" onclick="saveTheme()">Save Theme</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('user/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('user/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script>
        const calendar = document.getElementById('calendar');
        let currentDate = new Date();
        const today = new Date(); // Tanggal hari ini

        // Fungsi untuk merender kalender
        function renderCalendar(date) {
            const month = date.getMonth();
            const year = date.getFullYear();

            // Menentukan jumlah hari dalam bulan
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDayIndex = new Date(year, month, 1).getDay();

            let calendarHTML = `<table class="table table-bordered text-center mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Minggu</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                        <th>Sabtu</th>
                                    </tr>
                                </thead>
                                <tbody>`;

            // Membuat baris tanggal
            let day = 1;
            for (let i = 0; i < 6; i++) {
                calendarHTML += '<tr>';
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDayIndex) {
                        calendarHTML += '<td></td>';
                    } else if (day > daysInMonth) {
                        calendarHTML += '<td></td>';
                    } else {
                        // Memeriksa apakah tanggal adalah hari ini
                        const isToday = day === today.getDate() && month === today.getMonth() && year === today
                            .getFullYear();
                        const cellClass = isToday ? 'bg-primary text-white' : ''; // Kelas CSS untuk hari ini
                        calendarHTML += `<td class="${cellClass}">${day}</td>`;
                        day++;
                    }
                }
                calendarHTML += '</tr>';
            }
            calendarHTML += '</tbody></table>';

            calendar.innerHTML =
                `<h5 class="text-center mb-3">${date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })}</h5>` +
                calendarHTML;
        }

        // Fungsi untuk berpindah bulan
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        });

        // Render kalender awal
        renderCalendar(currentDate);

         // Fungsi untuk mengaktifkan mode gelap atau terang
        function toggleDarkMode(isDark) {
            const body = document.body;
            if (isDark) {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
        }

        // Fungsi untuk menyimpan tema ke localStorage
        function saveTheme() {
            const isDark = document.getElementById('dark-version').checked;
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            alert('Theme has been saved!');
        }

        // Fungsi untuk menerapkan tema yang tersimpan
        function applySavedTheme() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                const isDark = savedTheme === 'dark';
                document.getElementById('dark-version').checked = isDark;
                toggleDarkMode(isDark);
            }
        }

        // Event listener untuk perubahan pada toggle switch
        document.getElementById('dark-version').addEventListener('change', function () {
            toggleDarkMode(this.checked);
        });

        // Terapkan tema saat halaman dimuat
        document.addEventListener('DOMContentLoaded', applySavedTheme);
    </script>
</body>

</html>

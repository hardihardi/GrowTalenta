<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="d-flex align-items-center me-3">
        <!-- Clock Display -->
        <span id="current-time" class="text-dark font-weight-bold me-3"></span>
        <!-- Location Display -->
        <span id="current-location" class="text-dark font-weight-bold"></span>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('admin/assets/img/avatars/avatars.png') }}" alt
                            class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

<script>
    // Function to update the clock
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('current-time').innerText = `${hours}:${minutes}:${seconds}`;
    }

    // Function to get location and display region name
    async function updateLocation() {
        const locationElement = document.getElementById('current-location');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    // Reverse Geocoding with OpenStreetMap
                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
                        if (response.ok) {
                            const data = await response.json();
                            const region = data.address.city || data.address.town || data.address.village || "Unknown location";
                            locationElement.innerText = region;
                        } else {
                            locationElement.innerText = "Unable to fetch location name";
                        }
                    } catch (error) {
                        locationElement.innerText = "Error fetching location";
                    }
                },
                (error) => {
                    locationElement.innerText = "Lokasi Tidak Dapat Diakses";
                }
            );
        } else {
            locationElement.innerText = "Geolocation not supported";
        }
    }

    // Update the clock every second
    setInterval(updateClock, 1000);
    updateClock(); // Initialize clock immediately

    // Get location on page load
    updateLocation();
</script>

<div class="flex items-center justify-between mb-6">
    @if (request()->routeIs('dashboard.show'))
    <h1 class="text-3xl font-bold">Selamat Datang, {{ session('name') }}</h1>
    @elseif (request()->routeIs('paket-ujian.show'))
    <h1 class="text-3xl font-bold">Pilih Paket Ujian</h1>
    @else
    <h1 class="text-3xl font-bold">Halo, {{ session('name') }}</h1>
    @endif


    <div class="relative inline-block text-left">
        <button id="dropdownButton" onclick="toggleDropdown()"
            class="inline-flex justify-center items-center w-full px-4 py-2 bg-white text-indigo-700 text-sm font-medium rounded-md shadow hover:bg-indigo-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            {{ session('name') }}
            <svg class="-mr-1 ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div id="dropdownMenu"
            class="hidden absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-opacity-5 z-10">
            <div class="py-1">
                <!-- Menu Profil -->
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-indigo-600 hover:bg-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Profil</span>
                </a>

                <!-- Form Logout -->
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logout-button"
                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72 1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }
    
    // Optional: close dropdown on click outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.getElementById('dropdownButton');
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>

<script>
    document.getElementById('logout-button').addEventListener('click', function(e) {
        e.preventDefault(); // Cegah submit form langsung

        Swal.fire({
            title: 'Yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form logout
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
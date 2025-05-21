<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Tryout Online')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">
    <div x-data="{ open: false }" class="flex flex-col min-h-screen bg-gray-50">

        <!-- Top Navbar -->
        <header class="bg-white shadow md:hidden p-4 flex justify-between items-center">
            <div class="text-xl font-bold text-indigo-700">Tryout Online</div>
            <button @click="open = !open" class="text-indigo-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </header>

        <!-- Sidebar for Desktop -->
        <div class="flex flex-1">
            <aside class="hidden md:block w-64 bg-white text-indigo-700 shadow-lg">
                @include('components.sidebar')
            </aside>

            <!-- Sidebar Dropdown for Mobile -->
            <aside x-show="open" @click.away="open = false"
                class="md:hidden absolute z-40 w-64 bg-white text-indigo-700 shadow-lg h-screen transition duration-300">
                @include('components.sidebar')
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6 md:p-8">
                <x-navbar :user="Auth::user()" />
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine JS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
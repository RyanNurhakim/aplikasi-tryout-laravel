<!-- Sidebar -->
<aside class="h-full w-64 bg-white text-indigo-700 shadow-lg">
    <div class=" p-4 text-lg font-bold border-b border-indigo-200 text-center lg:text-left">
    Tryout Online
    </div>
    <nav class="mt-6">
        <a href="{{ route('dashboard.show') }}"
            class="flex items-center gap-2 py-2.5 px-4 rounded-lg m-2 {{ request()->routeIs('dashboard.show') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white' : 'hover:bg-indigo-100 text-indigo-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('paket-ujian.show') }}"
            class="flex items-center gap-2 py-2.5 px-4 rounded-lg m-2 {{ request()->routeIs('paket-ujian.show') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white' : 'hover:bg-indigo-100 text-indigo-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span>Paket Ujian</span>
        </a>

        <span class="mx-2">Daftar Paket</span>
        <a href="#" class="flex items-center gap-2 py-2.5 px-4 hover:bg-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
            </svg>
            <span>Paket Simulasi SNBT</span>
        </a>

    </nav>
</aside>
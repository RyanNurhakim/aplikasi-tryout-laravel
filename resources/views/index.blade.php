<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tryout Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 bg-white shadow-sm">
        <nav class="container mx-auto flex items-center justify-between px-6 py-4">
            <div class="text-2xl font-bold text-indigo-600">Tryout Online</div>
            <div class="hidden md:flex space-x-6">
                <a href="#home" class="hover:text-indigo-600 font-semibold">Beranda</a>
                <a href="#fitur" class="hover:text-indigo-600 font-semibold">Fitur</a>
                <a href="#testimoni" class="hover:text-indigo-600 font-semibold">Testimoni</a>
                <a href="#kontak" class="hover:text-indigo-600 font-semibold">Kontak</a>
            </div>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-2xl">&#9776;</button>
            </div>
        </nav>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
            <a href="#home" class="block py-2 font-semibold">Beranda</a>
            <a href="#fitur" class="block py-2 font-semibold">Fitur</a>
            <a href="#testimoni" class="block py-2 font-semibold">Testimoni</a>
            <a href="#kontak" class="block py-2 font-semibold">Kontak</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
        <div class="text-center px-6">
            <h1 class="text-5xl font-bold leading-tight mb-6">Platform Tryout Online Terbaik</h1>
            <p class="text-lg mb-8 max-w-xl mx-auto">Persiapkan dirimu menghadapi ujian dengan simulasi tryout berkualitas, di mana saja dan kapan saja.</p>
            <a href="{{ route('login.show') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-full font-semibold shadow-md hover:bg-gray-100 transition">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">Kenapa Pilih Tryout Online Kami?</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-2 text-indigo-600">Soal Terupdate</h3>
                    <p>Kami menyediakan soal terbaru dan sesuai kurikulum nasional.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-2 text-indigo-600">Pembahasan Lengkap</h3>
                    <p>Setiap soal dilengkapi pembahasan untuk memudahkan pemahaman.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-2 text-indigo-600">Statistik Hasil</h3>
                    <p>Lihat perkembangan nilai dan evaluasi belajar secara real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">Apa Kata Mereka?</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="p-6 border rounded-lg">
                    <p>"Tryout Online ini sangat membantu saya dalam mempersiapkan UTBK. Soalnya mirip banget!"</p>
                    <p class="mt-4 font-semibold text-indigo-600">– Rina, Siswa SMA</p>
                </div>
                <div class="p-6 border rounded-lg">
                    <p>"Platformnya sangat user-friendly, anak-anak jadi lebih semangat belajar."</p>
                    <p class="mt-4 font-semibold text-indigo-600">– Bapak Agus, Guru Bimbel</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
            <p class="mb-4">Ingin kerja sama atau tanya-tanya? Kirim email ke:</p>
            <a href="mailto:info@tryoutonline.com" class="text-indigo-600 font-semibold text-lg">info@tryoutonline.com</a>
        </div>
    </section>

    <footer class="bg-white text-center py-6 border-t">
        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Tryout Online. All rights reserved. By Ryan Nurhakim</p>
    </footer>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
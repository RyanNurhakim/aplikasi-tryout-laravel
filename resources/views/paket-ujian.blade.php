@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="flex min-h-screen bg-gradient-to-br bg-gray-50">

    <!-- Main Content -->
    <main class="flex-1">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div x-data="{ open: false }">
                <!-- Card: Paket Simulasi -->
                <div class="bg-white rounded-lg shadow p-5 text-gray-900 border hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold mb-1">Paket Simulasi</h3>
                    <p class="text-sm text-gray-600 mb-2">Paket 1x tryout SNBT gratis</p>
                    <div class="text-xl font-bold text-indigo-600 mb-3">Gratis</div>
                    <ul class="text-sm text-gray-700 mb-4 list-disc list-inside space-y-1">
                        <li>Variasi Soal Ter-update dan Prediktif</li>
                        <li>Penilaian IRT (Khusus TO SNBT Premium)</li>
                        <li>Tanpa Pembahasan</li>
                    </ul>
                    <button @click="open = true" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition cursor-pointer">
                        Coba Sekarang
                    </button>
                </div>

                <!-- Modal -->
                <div x-show="open" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50" style="display: none;">
                    <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-4">
                        <h2 class="text-xl font-bold text-indigo-700">Konfirmasi Simulasi</h2>
                        <p class="text-gray-700">Kamu akan memulai simulasi SNBT. Pastikan kamu sudah siap karena waktu akan berjalan otomatis.</p>

                        <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                            <li>Waktu pengerjaan: 90 menit</li>
                            <li>Tidak bisa mengulang sesi yang sama</li>
                            <li>Tidak tersedia pembahasan</li>
                        </ul>

                        <div class="flex justify-end space-x-2 pt-4">
                            <button @click="open = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</button>
                            <a href="{{ route('pengerjaan-soal', ['id_soal' => $soals[0]['id'] ?? null]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Mulai Simulasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Paket Basic -->
            <div class="bg-white rounded-lg shadow p-5 text-gray-900 border hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-1">Paket Basic</h3>
                <p class="text-sm text-gray-600 mb-2">Paket 2x tryout SBNT</p>
                <div class="text-xl font-bold text-indigo-600 mb-3">Rp 35.000</div>
                <ul class="text-sm text-gray-700 mb-4 list-disc list-inside space-y-1">
                    <li>Variasi Soal Ter-update dan Prediktif</li>
                    <li>Penilaian IRT (Khusus TO SNBT Premium)</li>
                    <li>Tanpa Pembahasan</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">Beli Sekarang</button>
            </div>

            <!-- Card: Paket Premium -->
            <div class="bg-white rounded-lg shadow p-5 text-gray-900 border hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-1">Paket Premium</h3>
                <p class="text-sm text-gray-600 mb-2">Paket 5x tryout SBNT</p>
                <div class="text-xl font-bold text-indigo-600 mb-3">Rp 75.000</div>
                <ul class="text-sm text-gray-700 mb-4 list-disc list-inside space-y-1">
                    <li>Variasi Soal Ter-update dan Prediktif</li>
                    <li>Penilaian IRT (Khusus TO SNBT Premium)</li>
                    <li>Pembahasan Lengkap</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">Beli Sekarang</button>
            </div>

            <!-- Card: Paket Ultimate -->
            <div class="bg-white rounded-lg shadow p-5 text-gray-900 border hover:shadow-lg transition">
                <h3 class="text-lg font-semibold mb-1">Paket Ultimate</h3>
                <p class="text-sm text-gray-600 mb-2">Paket 10x tryout SBNT</p>
                <div class="text-xl font-bold text-indigo-600 mb-3">Rp 150.000</div>
                <ul class="text-sm text-gray-700 mb-4 list-disc list-inside space-y-1">
                    <li>Variasi Soal Ter-update dan Prediktif</li>
                    <li>Penilaian IRT (Khusus TO SNBT Premium)</li>
                    <li>Diskusi Grup + Pembahasan</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">Beli Sekarang</button>
            </div>
        </div>

    </main>
</div>
@endsection
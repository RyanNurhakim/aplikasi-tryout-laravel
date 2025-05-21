<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        class="fixed bottom-5 right-5 z-50 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md transition">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        class="fixed bottom-5 right-5 z-50 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md transition">
        {{ session('error') }}
    </div>
    @endif

    <div class="min-h-screen flex bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-0 p-4 space-y-4">
            <div class="space-y-4">
                <h2 class="text-lg font-bold">Informasi</h2>
                <p class="text-gray-600">Nama Peserta: <span class="font-medium">Ryan</span></p>
                <p class="text-gray-600">Nama Ujian: <span class="font-medium">Simulasi SNBT</span></p>

                <div
                    x-data="countdownTimer(90 * 60)"
                    x-init="startTimer()"
                    class="p-4 bg-white shadow rounded text-gray-800 max-w-md mx-auto mt-6">
                    <p class="text-gray-600 text-lg">
                        Waktu Tersisa:
                        <span class="font-semibold text-red-600 text-xl" x-text="formattedTime"></span>
                    </p>
                </div>

                <script>
                    function countdownTimer(initialDuration) {
                        return {
                            storageKey: 'simulasi_waktu_tersisa',
                            timeLeft: 0,
                            formattedTime: '',
                            interval: null,

                            formatTime(seconds) {
                                const minutes = String(Math.floor(seconds / 60)).padStart(2, '0');
                                const secs = String(seconds % 60).padStart(2, '0');
                                return `${minutes}:${secs}`;
                            },

                            startTimer() {
                                // Periksa apakah ada waktu tersisa di localStorage, jika tidak gunakan initialDuration.
                                const savedTime = localStorage.getItem(this.storageKey);
                                this.timeLeft = savedTime !== null ? parseInt(savedTime) : initialDuration;

                                this.formattedTime = this.formatTime(this.timeLeft);

                                this.interval = setInterval(() => {
                                    if (this.timeLeft > 0) {
                                        this.timeLeft--;
                                        this.formattedTime = this.formatTime(this.timeLeft);
                                        // Simpan sisa waktu di localStorage setiap detik
                                        localStorage.setItem(this.storageKey, this.timeLeft);
                                    } else {
                                        clearInterval(this.interval);
                                        this.formattedTime = "00:00";
                                        localStorage.removeItem(this.storageKey);
                                        alert("Waktu habis!");
                                    }
                                }, 1000);
                            }
                        }
                    }
                </script>

            </div>

            <!-- Nomor Soal -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Nomor Soal</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2" id="nomor-soal-container">
                    @foreach ($soalIds as $index => $id)
                    <a href="{{ route('pengerjaan-soal', ['id_soal' => $id]) }}"
                        data-id-soal="{{ $id }}"
                        data-index="{{ $index }}"
                        class="w-10 h-10 flex items-center justify-center rounded border border-gray-300 text-sm font-medium {{ $index === $currentIndex ? 'bg-gradient-to-br from-indigo-500 to-purple-600 text-white' : 'text-indigo-500 hover:bg-gradient-to-br from-indigo-500 to-purple-600 hover:text-white' }}">
                        {{ $index + 1 }}
                    </a>
                    @endforeach
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const nomorSoalLinks = document.querySelectorAll('#nomor-soal-container a');

                        nomorSoalLinks.forEach(link => {
                            const idSoal = link.getAttribute('data-id-soal');
                            // Cek apakah ada jawaban untuk soal ini di localStorage
                            if (localStorage.getItem('answer_' + idSoal) !== null) {
                                // Beri kelas 'active' untuk menandai sudah ada jawaban
                                link.classList.remove('text-indigo-500', 'hover:bg-gradient-to-br', 'hover:text-white');
                                link.classList.add('bg-green-600', 'text-white');
                            }
                        });
                    });
                </script>

            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-6">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">

                <div id="soal-container" data-id-soal="{{ $soal['id'] }}">
                    <h2 class="text-xl font-bold mb-2">Soal No. {{ $soal['no_soal'] }}</h2>
                    <p class="text-gray-700">{!! $soal['soal'] !!}</p><br>

                    <!-- Option Jawaban -->
                    <div class="space-y-3">
                        @foreach ($soal['tryout_question_option'] as $option)
                        <label class="flex items-center space-x-2">
                            <input
                                type="radio"
                                name="answer"
                                value="{{ $option['iscorrect'] }}"
                                class="answer-radio"
                                data-id-soal="{{ $soal['id'] }}">
                            <span>{!! $option['inisial'] . '. ' . $option['jawaban'] !!}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const soalContainer = document.getElementById('soal-container');
                        const idSoal = soalContainer.getAttribute('data-id-soal');

                        // Restore jawaban dari localStorage jika ada
                        const savedAnswer = localStorage.getItem('answer_' + idSoal);
                        if (savedAnswer) {
                            const radios = document.querySelectorAll('input.answer-radio[data-id-soal="' + idSoal + '"]');
                            radios.forEach(radio => {
                                if (radio.value === savedAnswer) {
                                    radio.checked = true;
                                }
                            });
                        }

                        // Simpan jawaban saat radio dipilih
                        const radios = document.querySelectorAll('input.answer-radio[data-id-soal="' + idSoal + '"]');
                        radios.forEach(radio => {
                            radio.addEventListener('change', function() {
                                if (this.checked) {
                                    localStorage.setItem('answer_' + idSoal, this.value);
                                }
                            });
                        });
                    });
                </script>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200 gap-3">
                    @php
                    $prevIndex = $currentIndex - 1;
                    $nextIndex = $currentIndex + 1;
                    @endphp

                    <a href="{{ $prevIndex >= 0 ? route('pengerjaan-soal', ['id_soal' => $soalIds[$prevIndex]]) : '#' }}"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition
                        {{ $prevIndex < 0 ? 'opacity-50 pointer-events-none' : '' }}">
                        Back
                    </a>

                    <div class="flex space-x-2">
                        <button data-modal-target="lapor-modal" data-modal-toggle="lapor-modal" class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded hover:bg-yellow-200 transition">
                            Lapor Soal
                        </button>

                        <!-- Modal Lapor Soal -->
                        <div id="lapor-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 rounded-t bg-gradient-to-br from-indigo-500 to-purple-600">
                                        <h3 class="text-xl font-semibold text-white">
                                            Laporan Soal
                                        </h3>
                                        <button type="button" class="text-white bg-transparent hover:bg-white hover:text-indigo-600 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="lapor-modal">
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 bg-white">
                                        <form class="space-y-4" method="POST" action="{{ route('laporan-soal') }}">
                                            @csrf
                                            <input type="hidden" name="tryout_question_id" value="{{ $soal['id'] }}" />
                                            <div>
                                                <label for="laporan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Keterangan Masalah</label>
                                                <textarea id="laporan" name="laporan" rows="4" class="w-full p-2.5 rounded-lg border border-gray-300 text-gray-900 dark:bg-white dark:text-gray-900" placeholder="Jelaskan masalah pada soal ini..." required></textarea>
                                            </div>
                                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg px-5 py-2.5 transition">
                                                Kirim Laporan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($soal['no_soal'] == $jumlahSoal)
                        <button id="btn-selesai" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Selesai</button>
                        @endif
                        <a href="{{ $nextIndex < $jumlahSoal ? route('pengerjaan-soal', ['id_soal' => $soalIds[$nextIndex]]) : '#' }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition
                            {{ $nextIndex >= $jumlahSoal ? 'opacity-50 pointer-events-none' : '' }}">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selesaiButton = document.getElementById('btn-selesai');
            if (selesaiButton) {
                selesaiButton.addEventListener('click', function() {
                    const soalIds = @json($soalIds);
                    let benar = 0;

                    soalIds.forEach(id => {
                        const jawaban = localStorage.getItem('answer_' + id);
                        if (jawaban === "1") {
                            benar++;
                        }
                        localStorage.removeItem('answer_' + id); // hapus jawaban
                    });

                    localStorage.removeItem('simulasi_waktu_tersisa'); // hapus waktu agar reset
                    const skor = benar * 20;

                    // Redirect ke dashboard (atau ganti ke halaman hasil)
                    window.location.href = `/dashboard?benar=${benar}&total=${soalIds.length}&skor=${skor}`;
                });
            }
        });
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
@extends('layout')

@section('title', 'Dashboard')

@section('content')

<!-- Card Section -->
<div class="grid grid-cols-1 gap-6">

    <!-- Riwayat -->
    @if($skor)
    <div class="bg-white rounded-lg shadow p-5 text-gray-900">
        <h2 class="text-base sm:text-lg font-semibold mb-2">Riwayat Ujian</h2>
        <p>Tryout Simulasi UTBK</p>
        <p class="text-sm sm:text-base text-gray-500">Benar: {{ $benar }} / {{ $total }}</p>
        <p class="text-sm sm:text-base text-gray-500 font-semibold">Skor: {{ $skor }}</p>
        <a href="#" class="text-indigo-600 hover:underline mt-2 inline-block">Lihat Detail</a>
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-5 text-gray-900">
        <h2 class="text-base sm:text-lg font-semibold mb-2">Riwayat Ujian</h2>
        <p>Tryout Simulasi UTBK</p>
        <p class="text-sm sm:text-base text-gray-500">Benar: -</p>
        <p class="text-sm sm:text-base text-gray-500 font-semibold">Skor: -</p>
        <a href="#" class="text-indigo-600 hover:underline mt-2 inline-block">Lihat Detail</a>
    </div>
    @endif

</div>
@endsection
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TryoutController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('login');
})->name('login.show');

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi.show');

Route::get('/dashboard', function (Request $request) {
    $benar = $request->query('benar');
    $total = $request->query('total');
    $skor = $request->query('skor');

    return view('dashboard', compact('benar', 'total', 'skor'));
})->name('dashboard.show');

Route::get('/paket-ujian', function () {
    $token = session('jwt_token'); // sesuaikan kalau token disimpan
    $response = Http::withToken($token)->get('https://api-test.eksam.cloud/api/v1/tryout/question');
    $soals = [];

    if ($response->successful()) {
        $soals = $response->json('data');
    }

    return view('paket-ujian', compact('soals'));
})->name('paket-ujian.show');

Route::get('/pengerjaan-soal', function () {
    return view('pengerjaan-soal');
})->name('pengerjaan-soal.show');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::get('/pengerjaan-soal/{id_soal?}', [TryoutController::class, 'showQuestion'])->name('pengerjaan-soal');
Route::post('/laporan-soal', [TryoutController::class, 'reportQuestion'])->name('laporan-soal');

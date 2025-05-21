<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $response = Http::post('https://api-test.eksam.cloud/api/v1/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Log::info('API LOGIN RESPONSE: ' . $response->body());

            if ($response->successful()) {
                $responseData = $response->json('data');

                session([
                    'jwt_token' => $responseData['access_token'],
                    'name' => $responseData['user']['name'],
                ]);

                return redirect(route('login.show'))->with('success', 'Login berhasil!');
            } else {
                return redirect()->back()->with('error', 'Login gagal! Periksa email dan password Anda.');
            }

            return back()->with('error', 'Email atau password salah.');
        } catch (\Exception $error) {
            Log::error('LOGIN ERROR: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Server error: ' . $error->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            // Ambil token dari session
            $token = $request->session()->get('jwt_token');

            if ($token) {
                // Kirim request logout ke API
                $response = Http::withToken($token)->post('https://api-test.eksam.cloud/api/v1/auth/logout');

                if ($response->successful()) {
                    // Hapus semua session
                    $request->session()->flush();

                    // Redirect ke halaman login dengan pesan sukses
                    return redirect(route('index'))->with('success', 'Logout berhasil!');
                } else {
                    // Kalau API logout gagal, tetap hapus session dan kasih pesan error
                    $request->session()->flush();
                    return redirect(route('index'))->with('error', 'Logout gagal dari server.');
                }
            } else {
                // Kalau token tidak ditemukan, hapus session dan redirect ke login
                $request->session()->flush();
                return redirect(route('index'))->with('error', 'Anda belum login.');
            }
        } catch (\Exception $e) {
            // Jika ada error, hapus session dan redirect dengan pesan error
            $request->session()->flush();
            return redirect(route('index'))->with('error', 'Terjadi kesalahan saat logout.');
        }
    }

    public function registrasi(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
                'password_confirmation' => 'required|string',
            ]);

            // Cek konfirmasi password manual
            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai.');
            }

            // Kirim ke API TANPA password_confirmation
            $response = Http::post('https://api-test.eksam.cloud/api/v1/auth/register', [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Log::info('API REGISTER RESPONSE: ' . $response->body());

            if ($response->successful()) {
                return redirect()->route('registrasi.show')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                $errorMessage = $response->json('message') ?? 'Registrasi gagal.';
                return redirect()->back()->with('error', $errorMessage);
            }
        } catch (\Exception $error) {
            Log::error('REGISTER ERROR: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Server error: ' . $error->getMessage());
        }
    }
}

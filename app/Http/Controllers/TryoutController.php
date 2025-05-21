<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TryoutController extends Controller
{
    public function showQuestion($id_soal = null)
    {
        try {
            $token = session('jwt_token'); // pastikan sudah ada

            $response = Http::withToken($token)
                ->get('https://api-test.eksam.cloud/api/v1/tryout/question');

            if ($response->successful()) {
                $soals = $response->json('data');

                if (empty($soals)) {
                    return abort(404, 'Soal tidak ditemukan');
                }

                // Jika tidak ada id_soal di URL, pakai soal pertama
                if (!$id_soal) {
                    $id_soal = $soals[0]['id'];
                }

                // Ambil soal detail by id_soal
                $soalDetailResponse = Http::withToken($token)
                    ->get("https://api-test.eksam.cloud/api/v1/tryout/question/{$id_soal}");

                if ($soalDetailResponse->successful()) {
                    // Cari index soal saat ini di list soal
                    $currentIndex = collect($soals)->search(fn($s) => $s['id'] == $id_soal);

                    return view('pengerjaan-soal', [
                        'jumlahSoal' => count($soals),
                        'soal' => $soalDetailResponse->json('data'),
                        'soalIds' => array_column($soals, 'id'),
                        'currentIndex' => $currentIndex,
                    ]);
                }
            }

            return abort(404, 'Soal tidak ditemukan');
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return redirect()->back()->with('error', 'Server error: ' . $error->getMessage());
        }
    }

    public function reportQuestion(Request $request)
    {
        try {
            $request->validate([
                'tryout_question_id' => 'required|integer',
                'laporan' => 'required|string|max:1000',
            ]);

            // Ambil token JWT dari session
            $token = session('jwt_token');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('https://api-test.eksam.cloud/api/v1/tryout/lapor-soal/create', [
                'tryout_question_id' => $request->tryout_question_id,
                'laporan' => $request->laporan,
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Laporan soal berhasil dikirim.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengirim laporan soal. Silakan coba lagi.');
            }
        } catch (\Exception $error) {
            Log::error('Error saat kirim laporan soal: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Server error: ' . $error->getMessage());
        }
    }
}

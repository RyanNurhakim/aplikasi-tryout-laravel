# 📘 Aplikasi Tryout Online

Sebuah aplikasi web berbasis Laravel yang digunakan untuk menyelenggarakan tryout atau ujian simulasi secara online. Aplikasi ini dirancang untuk memberikan pengalaman seperti ujian sungguhan bagi pengguna, dengan fitur timer, penilaian otomatis, dan tampilan interaktif.

---

## 🚀 Fitur Utama

-   ✅ Registrasi & Login pengguna
-   🔍 Memilih paket ujian
-   📚 Menampilkan soal tryout pilihan ganda
-   ❌ Melaporkan kesalahan pada soal
-   ⏱ Timer otomatis dengan penyimpanan waktu (localStorage)
-   📊 Skor akhir langsung muncul setelah ujian
-   📥 Riwayat hasil tryout
-   🎯 Penilaian otomatis berdasarkan jawaban benar
-   📱 Responsif untuk perangkat mobile

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 12
-   **Frontend**: Blade Template, TailwindCSS, JavaScript
-   **Authentication**: JWT Auth
-   **Storage**: localStorage untuk penyimpanan sementara jawaban & timer

---

## Alur Aplikasi

-   1. Setelah masuk ke halaman landing page, user diarahkan untuk login
-   2. Jika belum mempunyai akun, user arahkan untuk melakukan registrasi dahulu
-   3. Setelah berhasil login dan masuk ke halaman dashboard, user diminta untuk ke halaman paket ujian
-   4. Pada halaman paket ujian user hanya bisa memilih Paket Simulasi, dan akan muncul pop up konfirmasi
-   5. Jika sudah melakukan konfirmasi, user akan diarahkan ke halaman pengerjaan soal, user dapat menjawab soal dan melaporkan jika ada kesalahan pada soal
-   6. JIka sudah selesai, user akan diarahkan kembali ke dashboard untuk melihat nilai dari hasil tryout

---

## ☎️ Kontak Personal

-   Nama: Ryan Nurhakim Arista Putra
-   Email: ryanurhakim10@gmail.com
-   GitHub: https://github.com/RyanNurhakim

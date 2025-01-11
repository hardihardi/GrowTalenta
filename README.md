<img src="https://iili.io/2ryrDep.md.png" alt="Logo" class="app-brand-logo" style="max-width: 100; height: auto;">

# GTMS - Grow Talenta Management System

Grow Talenta Management System (GTMS) adalah sebuah sistem untuk manajemen karyawan yang dirancang untuk memudahkan administrasi perusahaan dalam mengelola data karyawan, penggajian, cuti, absensi, dan rekrutmen.

---

## 📋 Fitur-Fitur

### Deskripsi
Berikut adalah fitur-fitur yang tersedia dalam HRMS:

### Fitur Khusus Admin

| Fitur             | Deskripsi                          |
|-------------------|------------------------------------|
| **Management Karyawan** | Mengelola data karyawan, termasuk menambah, mengedit, dan menghapus data karyawan. |
| **Penggajian Karyawan**  | Mengatur penggajian karyawan dengan perhitungan otomatis dan laporan gaji. |
| **Rekrutmen Karyawan**   | Mengelola proses rekrutmen mulai dari pengumuman lowongan hingga seleksi. |
| **Management Cuti**      | Mengatur pengajuan dan persetujuan cuti karyawan. |
| **Management Data Pribadi** | Mengelola informasi pribadi karyawan seperti alamat, kontak, dan dokumen penting. |
| **Management Data Absensi** | Mencatat dan memantau kehadiran karyawan. |
| **Management Laporan**   | Membuat laporan terkait kinerja dan data karyawan. |

### Fitur Khusus untuk Karyawan/User
- Absensi harian secara online.
- Pengajuan cuti langsung dari sistem.
- Izin sakit dengan mengunggah bukti.
- Melihat slip gaji dan histori pembayaran.

---
## Teknologi Yang Dipakai
- **Laravel 11 (Blade)** - Framework PHP untuk membangun aplikasi web yang cepat dan aman.
- **MySQL** - Basis data relasional untuk menyimpan data karyawan dan transaksi.
- **Packages** yang digunakan:
  - `socialite` - Untuk integrasi login menggunakan media sosial.
  - `laravel-notify` - Untuk menampilkan notifikasi.
  - `excel` - Untuk ekspor dan impor data dalam format Excel.
  - `tinker` - Untuk menjalankan perintah Artisan secara interaktif.
  - `sweet-alert` - Untuk menampilkan pesan alert yang interaktif dan menarik.

## 📚 Cara Install
Ikuti langkah-langkah berikut untuk menginstal project HRMS:

1. Clone atau download source code
    - Para terminal, clone repo `git@github.com:hardihardi/Human-Resource.git`
    - atau `git clone https://github.com/hardihardi/Human-Resource.git`
    - Jika tidak menggunakan Git, silakan **Download Zip** dan *extract* pada direktori web server (misal: laragon/www atau xampp/htdocs)
2. `cd GrowTalenta`
3. `composer install`
4. `cp .env.example .env`
    - Jika tidak menggunakan Git, bisa rename file `.env.example` menjadi `.env`
5. Pada terminal `php artisan key:generate`
6. Buat **database pada mysql** untuk aplikasi ini
7. **Setting database** pada file `.env`
8. `php artisan migrate --seed`
9. `php artisan serve`
10. Selesai

---

## 💡 Catatan Tambahan

- Gunakan `php artisan tinker` untuk mencoba perintah di terminal.
- Pastikan semua dependensi terinstal dengan benar.

---

**GTMS** adalah solusi terbaik untuk mempermudah proses administrasi sumber daya manusia di perusahaan Anda!

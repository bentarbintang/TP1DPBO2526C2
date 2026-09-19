# TP1DPBO2526C2

## Aplikasi Management Bioskop (Multi-Bahasa)

## Janji

```
Saya Bentar Bintang Umeir dengan nim 2509865 mengerjakan TP1 dalam mata kuliah DPBO untuk 
keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin
```

---

## 1. Deskripsi Program

Program ini adalah aplikasi **CRUD (Create, Read, Update, Delete)** sederhana untuk mengelola data tiket bioskop. Satu tiket memiliki atribut:

| Atribut       | Tipe   | Keterangan                                   |
|---------------|--------|-----------------------------------------------|
| `kodeTiket`   | string | Kode unik tiket (contoh: T01)                 |
| `namaFilm`    | string | Judul film                                    |
| `harga`       | int    | Harga tiket                                   |
| `nomorKursi`  | string | Nomor kursi penonton                          |
| `namaBioskop` | string | Nama bioskop tempat menonton                  |
| `gambar`      | string | *(khusus PHP)* path file lokal poster/gambar  |

Program diimplementasikan dalam **4 bahasa**:

1. **Java** — versi console asli (`Main.java` + `Tiket.java`)
2. **C++** — versi console (`cpp/main.cpp` + `cpp/Tiket.h` + `cpp/Tiket.cpp`)
3. **Python** — versi console (`python/main.py` + `python/tiket.py`)
4. **PHP** — versi web (`php/index.php`, `php/tambah.php`, `php/update.php`, `php/hapus.php`, `php/cari.php`, `php/Tiket.php`, `php/fungsi.php`)

Konsep dan struktur logikanya **sama persis di keempat bahasa** — hanya sintaks dan cara input/outputnya yang menyesuaikan karakteristik masing-masing bahasa (console vs web).

---

## 2. Penjelasan Desain

### 2.1 Konsep Object-Oriented Programming (OOP)

Di semua bahasa, data tiket dibungkus dalam **class `Tiket`** dengan pola yang sama:

- **Atribut private** — data (`kodeTiket`, `namaFilm`, `harga`, `nomorKursi`, `namaBioskop`, dan `gambar` khusus PHP) disembunyikan dari akses langsung (*encapsulation*).
- **Constructor** — untuk membuat objek tiket baru sekaligus mengisi semua atributnya.
- **Getter & Setter** — satu-satunya cara mengakses/mengubah atribut dari luar class, supaya data tetap terkontrol.

Alasan desain ini dipertahankan di semua bahasa: agar program mudah dibaca, gampang di-*maintain*, dan logika utamanya (di `main`) tidak perlu tahu detail internal `Tiket` — cukup panggil getter/setter-nya.

### 2.2 Penyimpanan Data

| Bahasa | Media Penyimpanan                          |
|--------|---------------------------------------------|
| Java   | `ArrayList<Tiket>` di memory                 |
| C++    | `std::vector<Tiket>` di memory               |
| Python | `list` Python biasa di memory                |
| PHP    | `$_SESSION['listTiket']` (array asosiatif)   |

Semua versi console (Java/C++/Python) menyimpan data selama program berjalan (hilang saat program ditutup — sesuai instruksi kuis tanpa database). Versi PHP memakai `$_SESSION` supaya data tetap ada selama sesi browser aktif, tanpa perlu database, sesuai ketentuan soal.

### 2.3 Tampilan Tabel

Semua versi console mencetak tabel menggunakan format kolom lebar tetap:
- Java & C++: `printf`/`iomanip` dengan `%-Ns` (lebar tetap kiri-rata)
- Python: `"{:<N}".format(...)`

Sehingga hasil tampilan tabelnya konsisten rapi di ketiga bahasa tersebut, walaupun sintaksnya beda.

Versi PHP menampilkan tabel sungguhan memakai tag HTML `<table>`, karena ini aplikasi web — bukan teks di terminal.

### 2.4 Khusus PHP (Versi Web)

Sesuai ketentuan soal, versi PHP dibangun dengan:

- **HTML Form** untuk semua input (tambah, update, cari) — bukan `<input>` biasa tanpa form, tapi form lengkap dengan method `POST`.
- **Tabel HTML** (`index.php` dan `cari.php`) untuk menampilkan data, lengkap dengan kolom gambar/poster.
- **Tanpa database** — seluruh data disimpan di `$_SESSION`, dengan struktur array asosiatif hasil `toArray()`/`fromArray()` dari class `Tiket`.
- **Atribut gambar** — form tambah/update punya input `type="file"`. File yang diupload disimpan secara lokal di folder `php/uploads/` (bukan diupload ke layanan luar/URL), lalu **path lokal**-nya (misalnya `uploads/tiket_xxxx.jpg`) disimpan sebagai atribut `gambar` pada objek `Tiket`.

File `fungsi.php` berisi semua fungsi helper (`ambilSemuaTiket`, `tambahTiketData`, `cariTiketData`, `updateTiketData`, `hapusTiketData`, `prosesUploadGambar`) supaya setiap halaman (`index.php`, `tambah.php`, dll) tidak perlu menulis ulang logika CRUD-nya — cukup panggil fungsinya.

---

## 3. Flow / Alur Program

### 3.1 Versi Console (Java, C++, Python)

Ketiganya mengikuti alur yang identik:

```
1. Program mulai, 2 data tiket dummy dimasukkan ke list/array
2. Tampilkan menu:
   1. Tambah Tiket
   2. Tampilkan Tiket
   3. Update Tiket
   4. Hapus Tiket
   5. Cari Tiket
   6. Keluar
3. User pilih menu (loop terus sampai pilih 6)
   - Tambah   -> input data baru -> masukkan ke list
   - Tampilkan -> cetak semua data dalam bentuk tabel
   - Update   -> cari data by kode -> kalau ketemu, input data baru -> update
   - Hapus    -> cari data by kode -> kalau ketemu, hapus dari list
   - Cari     -> cari data by kode -> kalau ketemu, tampilkan detail dalam tabel
4. Pilih 6 -> program selesai, cetak "Terima kasih!"
```

Fungsi `cariTiket(kodeTiket)` dipakai bersama oleh menu Update, Hapus, dan Cari — supaya logika pencarian tidak ditulis berulang-ulang (DRY principle).

### 3.2 Versi PHP (Web)

Alur berbasis navigasi antar halaman (bukan loop menu seperti console):

```
index.php  (halaman utama)
   |
   |-- menampilkan tabel semua tiket (ambil dari $_SESSION lewat fungsi.php)
   |-- tombol "Tambah Tiket"  -> tambah.php
   |-- tombol "Cari Tiket"    -> cari.php
   |-- per baris ada tombol "Update" -> update.php?kode=xxx
   |-- per baris ada tombol "Hapus"  -> hapus.php?kode=xxx (redirect balik ke index.php)

tambah.php
   |-- tampilkan HTML form (kode, nama film, harga, kursi, bioskop, gambar)
   |-- submit (POST) -> validasi -> upload gambar (kalau ada) -> simpan ke session -> redirect ke index.php

update.php?kode=xxx
   |-- ambil data lama by kode dari session
   |-- tampilkan form ter-prefill dengan data lama
   |-- submit (POST) -> validasi -> (ganti gambar kalau upload baru) -> update session -> redirect ke index.php

hapus.php?kode=xxx
   |-- langsung hapus data by kode dari session -> redirect ke index.php

cari.php
   |-- tampilkan form pencarian (kode tiket)
   |-- submit (POST) -> cari data by kode -> tampilkan hasil dalam tabel (atau pesan "tidak ditemukan")
```

Semua halaman PHP memanggil `require_once 'fungsi.php'` di baris paling atas, supaya fungsi CRUD dan session selalu siap dipakai.

---

## 4. Struktur File

```
TP1DPBO2526C2/
├── CPP/
│   ├── Main.cpp
│   ├── Tiket.cpp
│   └── program_bioskop.exe
├── JAVA/
│   ├── Main.class
│   ├── Main.java
│   ├── Tiket.class
│   └── Tiket.java
├── PHP/
│   ├── Tiket.php
│   ├── cari.php
│   ├── fungsi.php
│   ├── hapus.php
│   ├── index.php
│   ├── tambah.php
│   └── update.php
├── PYTHON/
│   ├── pycache/
│   ├── Main.py
│   └── Tiket.py
└── README.md
```

---

## 5. Dokumentasi
```
Dokumentasi dan compile bahasa c++
```
<img width="959" height="567" alt="image" src="https://github.com/user-attachments/assets/63abcac9-6872-4b1d-b1e9-15884969b082" />


```
Dokumentasi dan compile bahasa java 
```
<img width="959" height="563" alt="image" src="https://github.com/user-attachments/assets/5b8247bb-f417-4d8a-b24b-cd1164c3e2e3" />


```
Dokumentasi dan compile bahasa python
```
<img width="959" height="565" alt="image" src="https://github.com/user-attachments/assets/30d31f3a-6f13-40fb-9839-fb5076d44666" />


```
Dokumentasi bahasa php yang telah dijalankan di localhost
```
<img width="959" height="535" alt="Screenshot 2026-09-16 200623" src="https://github.com/user-attachments/assets/e2f042a2-71e3-45c6-b243-84f8eb38b8e7" />


```
Tampilan beranda/home dan delete
```
<img width="959" height="531" alt="Screenshot 2026-09-16 200653" src="https://github.com/user-attachments/assets/fdcfae98-56dd-40ba-8655-ef7adca886f5" />


```
Tampilan tampilan ketika ingin menambahkan data tiket
```
<img width="959" height="533" alt="Screenshot 2026-09-16 200702" src="https://github.com/user-attachments/assets/971759fa-984c-4026-8452-cf731f00a93f" />


```
Tampilan tampilan ketika ingin mencari data tiket
```
<img width="958" height="503" alt="Screenshot 2026-09-16 200711" src="https://github.com/user-attachments/assets/bd16ecf3-b18b-4d8d-b87c-b3ebb1ab0087" />


```
Tampilan tampilan ketika ingin menupdate data tiket
```
<img width="958" height="503" alt="Screenshot 2026-09-16 200711" src="https://github.com/user-attachments/assets/247d51db-8e95-4b55-80f2-dc64e7619d29" />




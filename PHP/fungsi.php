<?php
require_once __DIR__ . '/Tiket.php';

// mulai session kalau belum ada
function mulaiSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// ambil semua tiket dari session (isi awal/dummy kalau masih kosong)
function ambilSemuaTiket(): array {
    mulaiSession();

    if (!isset($_SESSION['listTiket'])) {
        $tiketDummy = [
            new Tiket("T01", "Avangers", 45000, "F19", "LTDIX", ""),
            new Tiket("T02", "Spiderman", 50000, "A1", "CGV", ""),
        ];
        $_SESSION['listTiket'] = array_map(fn(Tiket $t) => $t->toArray(), $tiketDummy);
    }

    return array_map(fn(array $data) => Tiket::fromArray($data), $_SESSION['listTiket']);
}

// simpan ulang seluruh list tiket ke session
function simpanSemuaTiket(array $listTiket): void {
    mulaiSession();
    $_SESSION['listTiket'] = array_map(fn(Tiket $t) => $t->toArray(), $listTiket);
}

// tambah 1 tiket baru
function tambahTiketData(Tiket $tiketBaru): void {
    $listTiket = ambilSemuaTiket();
    $listTiket[] = $tiketBaru;
    simpanSemuaTiket($listTiket);
}

// cari tiket berdasarkan kode, return Tiket atau null
function cariTiketData(string $kodeTiket): ?Tiket {
    $listTiket = ambilSemuaTiket();
    foreach ($listTiket as $tiket) {
        if ($tiket->getKodeTiket() === $kodeTiket) {
            return $tiket;
        }
    }
    return null;
}

// update tiket berdasarkan kode, return true kalau berhasil ditemukan & diupdate
function updateTiketData(string $kodeTiket, Tiket $dataBaru): bool {
    $listTiket = ambilSemuaTiket();
    foreach ($listTiket as $index => $tiket) {
        if ($tiket->getKodeTiket() === $kodeTiket) {
            $listTiket[$index] = $dataBaru;
            simpanSemuaTiket($listTiket);
            return true;
        }
    }
    return false;
}

// hapus tiket berdasarkan kode, return true kalau berhasil ditemukan & dihapus
function hapusTiketData(string $kodeTiket): bool {
    $listTiket = ambilSemuaTiket();
    foreach ($listTiket as $index => $tiket) {
        if ($tiket->getKodeTiket() === $kodeTiket) {
            unset($listTiket[$index]);
            simpanSemuaTiket(array_values($listTiket));
            return true;
        }
    }
    return false;
}

// proses upload gambar, return path lokal file atau string kosong kalau tidak ada file
function prosesUploadGambar(array $file): string {
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return "";
    }

    $folderUpload = __DIR__ . '/uploads/';
    if (!is_dir($folderUpload)) {
        mkdir($folderUpload, 0755, true);
    }

    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $ekstensiDiizinkan = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ekstensi, $ekstensiDiizinkan)) {
        return "";
    }

    $namaFileBaru = uniqid('tiket_', true) . '.' . $ekstensi;
    $pathTujuan = $folderUpload . $namaFileBaru;

    if (move_uploaded_file($file['tmp_name'], $pathTujuan)) {
        // simpan path lokal relatif, bukan URL
        return 'uploads/' . $namaFileBaru;
    }

    return "";
}

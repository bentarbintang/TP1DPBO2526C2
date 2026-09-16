<?php
require_once __DIR__ . '/fungsi.php';
mulaiSession();

$kodeTiket = $_GET['kode'] ?? '';

if ($kodeTiket !== '' && hapusTiketData($kodeTiket)) {
    $_SESSION['pesan'] = 'Tiket berhasil dihapus!';
} else {
    $_SESSION['pesan'] = "Tiket dengan kode {$kodeTiket} tidak ditemukan.";
}

header('Location: index.php');
exit;

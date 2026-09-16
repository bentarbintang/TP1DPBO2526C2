<?php
require_once __DIR__ . '/fungsi.php';
mulaiSession();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeTiket   = trim($_POST['kodeTiket'] ?? '');
    $namaFilm    = trim($_POST['namaFilm'] ?? '');
    $harga       = (int)($_POST['harga'] ?? 0);
    $nomorKursi  = trim($_POST['nomorKursi'] ?? '');
    $namaBioskop = trim($_POST['namaBioskop'] ?? '');

    if ($kodeTiket === '' || $namaFilm === '') {
        $error = 'Kode tiket dan nama film wajib diisi!';
    } elseif (cariTiketData($kodeTiket) !== null) {
        $error = 'Kode tiket sudah digunakan, silakan pakai kode lain!';
    } else {
        $pathGambar = '';
        if (!empty($_FILES['gambar']['name'])) {
            $pathGambar = prosesUploadGambar($_FILES['gambar']);
        }

        $tiketBaru = new Tiket($kodeTiket, $namaFilm, $harga, $nomorKursi, $namaBioskop, $pathGambar);
        tambahTiketData($tiketBaru);

        $_SESSION['pesan'] = 'Tiket berhasil ditambahkan!';
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tiket</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #222; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type=text], input[type=number], input[type=file] {
            width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 4px;
        }
        button { margin-top: 18px; padding: 10px 18px; background: #27ae60; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1e8449; }
        .kembali { display: inline-block; margin-top: 12px; color: #2c3e50; text-decoration: none; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Tambah Tiket</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="kodeTiket">Kode Tiket</label>
        <input type="text" id="kodeTiket" name="kodeTiket" value="<?= htmlspecialchars($_POST['kodeTiket'] ?? '') ?>" required>

        <label for="namaFilm">Nama Film</label>
        <input type="text" id="namaFilm" name="namaFilm" value="<?= htmlspecialchars($_POST['namaFilm'] ?? '') ?>" required>

        <label for="harga">Harga Tiket</label>
        <input type="number" id="harga" name="harga" min="0" value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>" required>

        <label for="nomorKursi">Nomor Kursi</label>
        <input type="text" id="nomorKursi" name="nomorKursi" value="<?= htmlspecialchars($_POST['nomorKursi'] ?? '') ?>">

        <label for="namaBioskop">Nama Bioskop</label>
        <input type="text" id="namaBioskop" name="namaBioskop" value="<?= htmlspecialchars($_POST['namaBioskop'] ?? '') ?>">

        <label for="gambar">Gambar / Poster (opsional)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <button type="submit">Simpan</button>
    </form>

    <a class="kembali" href="index.php">&larr; Kembali ke daftar tiket</a>
</div>
</body>
</html>

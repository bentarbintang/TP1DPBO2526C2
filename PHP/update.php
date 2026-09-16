<?php
require_once __DIR__ . '/fungsi.php';
mulaiSession();

$kodeTiket = $_GET['kode'] ?? ($_POST['kodeTiket'] ?? '');
$tiket = cariTiketData($kodeTiket);

if ($tiket === null) {
    $_SESSION['pesan'] = "Tiket dengan kode {$kodeTiket} tidak ditemukan.";
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaFilm    = trim($_POST['namaFilm'] ?? '');
    $harga       = (int)($_POST['harga'] ?? 0);
    $nomorKursi  = trim($_POST['nomorKursi'] ?? '');
    $namaBioskop = trim($_POST['namaBioskop'] ?? '');

    if ($namaFilm === '') {
        $error = 'Nama film wajib diisi!';
    } else {
        // gambar lama dipakai lagi kalau tidak upload gambar baru
        $pathGambar = $tiket->getGambar();
        if (!empty($_FILES['gambar']['name'])) {
            $gambarBaru = prosesUploadGambar($_FILES['gambar']);
            if ($gambarBaru !== '') {
                $pathGambar = $gambarBaru;
            }
        }

        $tiketBaru = new Tiket($kodeTiket, $namaFilm, $harga, $nomorKursi, $namaBioskop, $pathGambar);
        updateTiketData($kodeTiket, $tiketBaru);

        $_SESSION['pesan'] = 'Tiket berhasil diupdate!';
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Tiket</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #222; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type=text], input[type=number], input[type=file] {
            width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 4px;
        }
        input[readonly] { background: #eee; }
        button { margin-top: 18px; padding: 10px 18px; background: #2980b9; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1c5980; }
        .kembali { display: inline-block; margin-top: 12px; color: #2c3e50; text-decoration: none; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 10px; }
        .preview { margin-top: 10px; }
        .preview img { width: 100px; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Update Tiket</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="kodeTiket">Kode Tiket</label>
        <input type="text" id="kodeTiket" name="kodeTiket" value="<?= htmlspecialchars($tiket->getKodeTiket()) ?>" readonly>

        <label for="namaFilm">Nama Film</label>
        <input type="text" id="namaFilm" name="namaFilm" value="<?= htmlspecialchars($_POST['namaFilm'] ?? $tiket->getNamaFilm()) ?>" required>

        <label for="harga">Harga Tiket</label>
        <input type="number" id="harga" name="harga" min="0" value="<?= htmlspecialchars($_POST['harga'] ?? $tiket->getHarga()) ?>" required>

        <label for="nomorKursi">Nomor Kursi</label>
        <input type="text" id="nomorKursi" name="nomorKursi" value="<?= htmlspecialchars($_POST['nomorKursi'] ?? $tiket->getNomorKursi()) ?>">

        <label for="namaBioskop">Nama Bioskop</label>
        <input type="text" id="namaBioskop" name="namaBioskop" value="<?= htmlspecialchars($_POST['namaBioskop'] ?? $tiket->getNamaBioskop()) ?>">

        <label for="gambar">Ganti Gambar / Poster (opsional)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <?php if ($tiket->getGambar() && file_exists(__DIR__ . '/' . $tiket->getGambar())): ?>
            <div class="preview">
                <p>Gambar saat ini:</p>
                <img src="<?= htmlspecialchars($tiket->getGambar()) ?>" alt="Poster saat ini">
            </div>
        <?php endif; ?>

        <button type="submit">Update</button>
    </form>

    <a class="kembali" href="index.php">&larr; Kembali ke daftar tiket</a>
</div>
</body>
</html>

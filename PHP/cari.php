<?php
require_once __DIR__ . '/fungsi.php';
mulaiSession();

$hasil = null;
$sudahCari = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeTiket = trim($_POST['kodeTiket'] ?? '');
    $hasil = cariTiketData($kodeTiket);
    $sudahCari = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Tiket</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #222; }
        form { display: flex; gap: 8px; margin-bottom: 20px; }
        input[type=text] { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 16px; background: #8e44ad; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #6c3483; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; }
        th { background: #2c3e50; color: #fff; }
        img.thumb { width: 90px; border-radius: 4px; }
        .tidak-ada { text-align: center; color: #c0392b; margin-top: 10px; }
        .kembali { display: inline-block; margin-top: 15px; color: #2c3e50; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Cari Tiket</h1>

    <form method="post">
        <input type="text" name="kodeTiket" placeholder="Masukkan kode tiket, misal T01" required
               value="<?= htmlspecialchars($_POST['kodeTiket'] ?? '') ?>">
        <button type="submit">Cari</button>
    </form>

    <?php if ($sudahCari): ?>
        <?php if ($hasil !== null): ?>
            <table>
                <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Kode</th>
                    <th>Nama Film</th>
                    <th>Harga</th>
                    <th>Kursi</th>
                    <th>Bioskop</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?php if ($hasil->getGambar() && file_exists(__DIR__ . '/' . $hasil->getGambar())): ?>
                            <img class="thumb" src="<?= htmlspecialchars($hasil->getGambar()) ?>" alt="Poster">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($hasil->getKodeTiket()) ?></td>
                    <td><?= htmlspecialchars($hasil->getNamaFilm()) ?></td>
                    <td>Rp<?= number_format($hasil->getHarga(), 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($hasil->getNomorKursi()) ?></td>
                    <td><?= htmlspecialchars($hasil->getNamaBioskop()) ?></td>
                </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p class="tidak-ada">Tiket dengan kode tersebut tidak ditemukan.</p>
        <?php endif; ?>
    <?php endif; ?>

    <a class="kembali" href="index.php">&larr; Kembali ke daftar tiket</a>
</div>
</body>
</html>

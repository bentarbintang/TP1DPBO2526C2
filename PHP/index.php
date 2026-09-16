<?php
require_once __DIR__ . '/fungsi.php';
mulaiSession();

$listTiket = ambilSemuaTiket();
$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Management Bioskop</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #222; }
        .menu { text-align: center; margin-bottom: 20px; }
        .menu a { display: inline-block; margin: 5px; padding: 8px 16px; background: #2c3e50; color: #fff; text-decoration: none; border-radius: 4px; }
        .menu a:hover { background: #1a252f; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; vertical-align: middle; }
        th { background: #2c3e50; color: #fff; }
        tr:nth-child(even) { background: #f9f9f9; }
        img.thumb { width: 70px; height: 90px; object-fit: cover; border-radius: 4px; }
        .no-gambar { color: #999; font-size: 12px; }
        .aksi a { margin-right: 8px; text-decoration: none; }
        .aksi .edit { color: #2980b9; }
        .aksi .hapus { color: #c0392b; }
        .pesan { text-align: center; padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #d4edda; color: #155724; }
    </style>
</head>
<body>
<div class="container">
    <h1>Management Bioskop</h1>

    <?php if ($pesan): ?>
        <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <div class="menu">
        <a href="tambah.php">Tambah Tiket</a>
        <a href="cari.php">Cari Tiket</a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Gambar</th>
            <th>Kode</th>
            <th>Nama Film</th>
            <th>Harga</th>
            <th>Kursi</th>
            <th>Bioskop</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($listTiket)): ?>
            <tr><td colspan="7" style="text-align:center;">Belum ada data tiket.</td></tr>
        <?php else: ?>
            <?php foreach ($listTiket as $tiket): ?>
                <tr>
                    <td>
                        <?php if ($tiket->getGambar() && file_exists(__DIR__ . '/' . $tiket->getGambar())): ?>
                            <img class="thumb" src="<?= htmlspecialchars($tiket->getGambar()) ?>" alt="Poster">
                        <?php else: ?>
                            <span class="no-gambar">Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($tiket->getKodeTiket()) ?></td>
                    <td><?= htmlspecialchars($tiket->getNamaFilm()) ?></td>
                    <td>Rp<?= number_format($tiket->getHarga(), 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($tiket->getNomorKursi()) ?></td>
                    <td><?= htmlspecialchars($tiket->getNamaBioskop()) ?></td>
                    <td class="aksi">
                        <a class="edit" href="update.php?kode=<?= urlencode($tiket->getKodeTiket()) ?>">Update</a>
                        <a class="hapus" href="hapus.php?kode=<?= urlencode($tiket->getKodeTiket()) ?>"
                           onclick="return confirm('Yakin ingin menghapus tiket ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';

// ambil data hasil + nama
$stmt = $pdo->query("
    SELECT h.*, a.nama 
    FROM tb_hasil h
    JOIN tb_alternatif a ON a.kode_alternatif = h.kode_alternatif
    ORDER BY h.ranking ASC
");
$data_hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil SAW - SPK Gizi Balita</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
    <div class="logo">
        <img src="img/pus.png" alt="logo">
    </div>
    <h1>Sistem Pendukung Keputusan Gizi Balita</h1>
    <div class="logo2">
        <img src="img/logo_dinkes.png" alt="logo">
    </div>
    </header>
    <div class="container">
        <button class="hamburger">&#9776;</button> <!-- ini icon ☰ -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="balita.php">Balita</a></li>
                    <li><a href="perhitungan.php">Perhitungan</a></li>
                    <li><a href="hasil.php">Hasil Nilai</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <div class="balita">
                <h2>Hasil Akhir Perhitungan SAW</h2>
                <a href="cetak.php" target="_blank" class="add-btn">Cetak</a>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Balita</th>
                            <th>Nilai Preferensi</th>
                            <th>Ranking</th>
                            <th>Status Gizi</th>
                            <th>Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data_hasil as $row):
                            $nilai = $row['nilai_akhir'];
                            if ($nilai >= 0.8) {
                                $status = "Gizi Baik";
                                $rekom = "Pertahankan pola makan, rutin susu & sayur.";
                            } elseif ($nilai >= 0.6) {
                                $status = "Gizi Berlebih";
                                $rekom = "Kurangi makanan manis & lemak, perbanyak aktivitas.";
                            } else {
                                $status = "Gizi Kurang";
                                $rekom = "Tambahkan protein, buah & susu.";
                            }
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nilai_akhir']) ?></td>
                            <td><?= htmlspecialchars($row['ranking']) ?></td>
                            <td><?= $status ?></td>
                            <td><?= $rekom ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>

<?php
require 'koneksi.php';

// ambil data hasil + nama
$stmt = $pdo->query("
    SELECT h.*, a.nama 
    FROM tb_hasil h
    JOIN tb_alternatif a ON a.kode_alternatif = h.kode_alternatif
    ORDER BY h.ranking ASC
");
$data_hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ambil tanggal sekarang
$tanggal = date("d-m-Y");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil SAW - SPK Gizi Balita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: white;
            padding: 20px;
            position: relative;
        }
        .tanggal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 14px;
            color: #555;
        }
        .logo {
            position: absolute;
            top: 50px;
            right: 20px;
        }
        .logo img {
            width: 80px;
            height: auto;
        }
        h2 {
            text-align: center;
            margin: 0 0 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 30px;
        }
        table th, table td {
            border: 1px solid #555;
            padding: 8px;
            text-align: left;
        }
        table th {
            background: #ccc;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body onload="window.print()">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div></div> <!-- kosong agar h2 tetap center -->
        <div style="margin-left: -500px;">
            <img src="img/logo_dinkes.png" alt="Logo Dinkes" style="width: 80px; height: auto;">
            <div style="font-size: 14px; color: #555; margin-top: 5px;">Tanggal cetak: <?= $tanggal ?></div>
        </div>
        <div style="text-align: left;">
        <img src="img/pus.png" alt="Logo Dinkes" style="width: 38px; height: auto;">
    </div>
    </div>

    <h2>Laporan Gizi Balita Pada Puskesmas</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Balita</th>
                <th>Nilai Preferensi</th>
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
                    $status = "Gizi Kurang";
                    $rekom = "Tambahkan protein, buah & susu.";
                } else {
                    $status = "Gizi Berlebih";
                    $rekom = "Kurangi makanan manis & lemak, perbanyak aktivitas.";
                }
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['nilai_akhir']) ?></td>
                <td><?= $status ?></td>
                <td><?= $rekom ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>

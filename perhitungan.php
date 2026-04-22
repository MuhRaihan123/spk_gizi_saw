<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';

// AMBIL BOBOT
$bobot = [];
$stmt_bobot = $pdo->query("SELECT id_kriteria, bobot FROM tb_kriteria");
while ($row = $stmt_bobot->fetch(PDO::FETCH_ASSOC)) {
    $bobot[$row['id_kriteria']] = $row['bobot'];
}

// AMBIL DATA HITUNG
$stmt_data = $pdo->query("SELECT * FROM tb_hitung");
$data = $stmt_data->fetchAll(PDO::FETCH_ASSOC);

// CARI MAX / MIN UNTUK NORMALISASI
$max_tinggi = $max_berat = $max_tinggi_lahir = $max_berat_lahir = 0;
$min_usia_tahun = PHP_INT_MAX;
foreach ($data as $row) {
    $min_usia_tahun = min($min_usia_tahun, $row['usia_tahun']);
    $max_tinggi = max($max_tinggi, $row['tinggi']);
    $max_berat = max($max_berat, $row['berat']);
    $max_tinggi_lahir = max($max_tinggi_lahir, $row['tinggi_lahir']);
    $max_berat_lahir = max($max_berat_lahir, $row['berat_lahir']);
}

// HITUNG NORMALISASI & NORMALISASI TERBOBOT
$preferensi = [];
foreach ($data as $row) {
    $kode = $row['kode_alternatif'];

    $n_usia = $min_usia_tahun / $row['usia_tahun']; // cost
    $n_tinggi = $row['tinggi'] / $max_tinggi;
    $n_berat = $row['berat'] / $max_berat;
    $n_tinggi_lahir = $row['tinggi_lahir'] / $max_tinggi_lahir;
    $n_berat_lahir = $row['berat_lahir'] / $max_berat_lahir;

    // normalisasi terbobot
    $c1 = $n_usia * $bobot[1];
    $c2 = $n_berat_lahir * $bobot[2];
    $c3 = $n_tinggi_lahir * $bobot[3];
    $c4 = $n_berat * $bobot[4];
    $c5 = $n_tinggi * $bobot[5];
    $nilai = $c1 + $c2 + $c3 + $c4 + $c5;

    $preferensi[] = [
        'kode' => $kode,
        'n_usia' => round($n_usia,4),
        'n_tinggi' => round($n_tinggi,4),
        'n_berat' => round($n_berat,4),
        'n_tinggi_lahir' => round($n_tinggi_lahir,4),
        'n_berat_lahir' => round($n_berat_lahir,4),
        'c1' => round($c1,4),
        'c2' => round($c2,4),
        'c3' => round($c3,4),
        'c4' => round($c4,4),
        'c5' => round($c5,4),
        'nilai' => round($nilai,4)
    ];
}

// SIMPAN KE tb_hasil
$pdo->query("TRUNCATE TABLE tb_hasil");
usort($preferensi, fn($a,$b) => $b['nilai'] <=> $a['nilai']);
$rank=1;
foreach ($preferensi as $row) {
    $stmt_insert = $pdo->prepare("INSERT INTO tb_hasil (kode_alternatif, nilai_akhir, ranking) VALUES (?, ?, ?)");
    $stmt_insert->execute([$row['kode'], $row['nilai'], $rank++]);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan SAW - SPK Gizi Balita</title>
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
        <button class="hamburger">&#9776;</button>
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
                 <h2>Data Hitung</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Usia Tahun</th>
                            <th>Berat</th>
                            <th>Tinggi</th>
                            <th>Berat Lahir</th>
                            <th>Tinggi Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($data as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['kode_alternatif']) ?></td>
                            <td><?= $d['usia_tahun'] ?></td>
                            <td><?= $d['berat'] ?></td>
                            <td><?= $d['tinggi'] ?></td>
                            <td><?= $d['berat_lahir'] ?></td>
                            <td><?= $d['tinggi_lahir'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <h2>Normalisasi</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Usia Tahun</th>
                            <th>Berat</th>
                            <th>Tinggi</th>
                            <th>Berat Lahir</th>
                            <th>Tinggi Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($preferensi as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($p['kode']) ?></td>
                            <td><?= $p['n_usia'] ?></td>
                            <td><?= $p['n_berat'] ?></td>
                            <td><?= $p['n_tinggi'] ?></td>
                            <td><?= $p['n_berat_lahir'] ?></td>
                            <td><?= $p['n_tinggi_lahir'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <h2>Normalisasi Terbobot</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($preferensi as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($p['kode']) ?></td>
                            <td><?= $p['c1'] ?></td>
                            <td><?= $p['c2'] ?></td>
                            <td><?= $p['c3'] ?></td>
                            <td><?= $p['c4'] ?></td>
                            <td><?= $p['c5'] ?></td>
                            <td><b><?= $p['nilai'] ?></b></td>
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

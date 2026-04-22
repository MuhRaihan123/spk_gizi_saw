<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_alternatif'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $usia = $_POST['usia_tahun'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $tinggi_lahir = $_POST['tinggi_lahir'];
    $berat_lahir = $_POST['berat_lahir'];

    // Insert ke tb_alternatif
    $stmt = $pdo->prepare("INSERT INTO tb_alternatif 
        (kode_alternatif, nama, jenis_kelamin, usia_tahun, tinggi, berat, tinggi_lahir, berat_lahir)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$kode, $nama, $jk, $usia, $tinggi, $berat, $tinggi_lahir, $berat_lahir]);

    // Catat ke log_activity
    if (isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
    } else {
        $user = 'Unknown';
    }
    $aktivitas = "Menambahkan data balita: $nama ($kode)";
    $pdo->prepare("INSERT INTO log_activity (user, aktivitas) VALUES (?, ?)")
        ->execute([$user, $aktivitas]);

    // Langsung jalankan konversi hitung ulang
    require 'konversi.php';

    header("Location: balita.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Balita</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header><h1>Tambah Data Balita</h1></header>
    <div class="container">
        <main class="content">
            <form method="POST">
                <input type="text" name="kode_alternatif" placeholder="Kode Alternatif" required>
                <input type="text" name="nama" placeholder="Nama" required>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="text" name="usia_tahun" placeholder="Usia (cth: 1 Tahun / 8 Bulan)" required>
                <input type="number" step="0.1" name="tinggi" placeholder="Tinggi (cm)" required>
                <input type="number" step="0.1" name="berat" placeholder="Berat (kg)" required>
                <input type="number" step="0.1" name="tinggi_lahir" placeholder="Tinggi Lahir (cm)" required>
                <input type="number" step="0.1" name="berat_lahir" placeholder="Berat Lahir (kg)" required>
                <button type="submit">Simpan</button>
            </form>
        </main>
    </div>
</body>
</html>

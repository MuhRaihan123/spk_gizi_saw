<?php
session_start();
require 'koneksi.php';
$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM tb_alternatif WHERE kode_alternatif=?");
$stmt->execute([$id]);
$balita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$balita) die("Data tidak ditemukan");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_alternatif'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $usia = $_POST['usia_tahun'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $tinggi_lahir = $_POST['tinggi_lahir'];
    $berat_lahir = $_POST['berat_lahir'];

    $stmt = $pdo->prepare("UPDATE tb_alternatif SET 
        kode_alternatif=?, nama=?, jenis_kelamin=?, usia_tahun=?, tinggi=?, berat=?, tinggi_lahir=?, berat_lahir=?
        WHERE kode_alternatif=?");
    $stmt->execute([$kode, $nama, $jk, $usia, $tinggi, $berat, $tinggi_lahir, $berat_lahir, $id]);

    // Catat ke log_activity
    $user = $_SESSION['username'] ?? 'Unknown';
    $aktivitas = "Mengedit data balita: $nama ($kode)";
    $pdo->prepare("INSERT INTO log_activity (user, aktivitas) VALUES (?, ?)")
        ->execute([$user, $aktivitas]);

    header("Location: balita.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Balita</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header><h1>Edit Data Balita</h1></header>
    <div class="container">
        <main class="content">
            <form method="POST">
                <input type="text" name="kode_alternatif" value="<?= htmlspecialchars($balita['kode_alternatif']) ?>" required>
                <input type="text" name="nama" value="<?= htmlspecialchars($balita['nama']) ?>" required>
                <select name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= $balita['jenis_kelamin']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $balita['jenis_kelamin']=='Perempuan'?'selected':'' ?>>Perempuan</option>
                </select>
                <input type="text" name="usia_tahun" value="<?= htmlspecialchars($balita['usia_tahun']) ?>" required>
                <input type="number" step="0.1" name="tinggi" value="<?= $balita['tinggi'] ?>" required>
                <input type="number" step="0.1" name="berat" value="<?= $balita['berat'] ?>" required>
                <input type="number" step="0.1" name="tinggi_lahir" value="<?= $balita['tinggi_lahir'] ?>" required>
                <input type="number" step="0.1" name="berat_lahir" value="<?= $balita['berat_lahir'] ?>" required>
                <button type="submit">Simpan Perubahan</button>
            </form>
        </main>
    </div>
</body>
</html>

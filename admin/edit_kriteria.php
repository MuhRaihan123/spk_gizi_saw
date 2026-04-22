<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tb_kriteria WHERE id_kriteria=?");
$stmt->execute([$id]);
$kriteria = $stmt->fetch();

if (!$kriteria) die("Kriteria tidak ditemukan.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_kriteria'];
    $nama = $_POST['nama_kriteria'];
    $bobot = $_POST['bobot'];
    $sifat = $_POST['sifat'];

    $pdo->prepare("UPDATE tb_kriteria SET kode_kriteria=?, nama_kriteria=?, bobot=?, sifat=? WHERE id_kriteria=?")
        ->execute([$kode, $nama, $bobot, $sifat, $id]);

    header('Location: ../admin/kriteria.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kriteria - Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header><h1>Edit Kriteria</h1></header>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="user.php">Data User</a></li>
                    <li><a href="kriteria.php">Data Kriteria</a></li>
                    <li><a href="sub_kriteria.php">Data Sub Kriteria</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <h2>Edit Kriteria</h2>
            <form method="POST">
                <label>Kode Kriteria</label>
                <input type="text" name="kode_kriteria" value="<?= htmlspecialchars($kriteria['kode_kriteria']) ?>" required>

                <label>Nama Kriteria</label>
                <input type="text" name="nama_kriteria" value="<?= htmlspecialchars($kriteria['nama_kriteria']) ?>" required>

                <label>Bobot</label>
                <input type="number" step="0.01" name="bobot" value="<?= htmlspecialchars($kriteria['bobot']) ?>" required>

                <label>Sifat</label>
                <select name="sifat" required>
                    <option value="benefit" <?= $kriteria['sifat']=='benefit'?'selected':'' ?>>Benefit</option>
                    <option value="cost" <?= $kriteria['sifat']=='cost'?'selected':'' ?>>Cost</option>
                </select>

                <button type="submit">Simpan Perubahan</button>
            </form>
            <a href="../admin/kriteria.php" class="back-btn">BACK</a>
        </main>
    </div>
</body>
</html>

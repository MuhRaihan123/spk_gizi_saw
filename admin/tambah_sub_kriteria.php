<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// ambil kriteria
$kriteria = $pdo->query("SELECT * FROM tb_kriteria")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sub = $_POST['id_sub'];
    $id_kriteria = $_POST['id_kriteria'];
    $deskripsi = $_POST['deskripsi'];
    $nilai = $_POST['nilai'];

    $stmt = $pdo->prepare("INSERT INTO tb_sub_kriteria (id_sub, id_kriteria, deskripsi, nilai) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_sub, $id_kriteria, $deskripsi, $nilai]);

    header('Location: ../admin/sub_kriteria.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Sub Kriteria - Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header><h1>Tambah Sub Kriteria</h1></header>
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
            <h2>Tambah Sub Kriteria</h2>
            <form method="POST">
                <label>ID Sub Kriteria</label>
                <input type="text" name="id_sub" required>

                <label>Kriteria</label>
                <select name="id_kriteria" required>
                    <option value="">- Pilih Kriteria -</option>
                    <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id_kriteria'] ?>"><?= $k['nama_kriteria'] ?></option>
                    <?php endforeach ?>
                </select>

                <label>Deskripsi</label>
                <input type="text" name="deskripsi" required>

                <label>Nilai</label>
                <input type="number" step="0.01" name="nilai" required>

                <button type="submit">Simpan</button>
            </form>
            <a href="../admin/sub_kriteria.php" class="back-btn">BACK</a>
        </main>
    </div>
</body>
</html>

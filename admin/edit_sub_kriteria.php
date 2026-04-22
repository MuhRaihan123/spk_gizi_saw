<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

$id = $_GET['id'];
$sub = $pdo->prepare("SELECT * FROM tb_sub_kriteria WHERE id_sub_kriteria=?");
$sub->execute([$id]);
$sub = $sub->fetch();

if (!$sub) die("Data tidak ditemukan.");

$kriteria = $pdo->query("SELECT * FROM tb_kriteria")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sub_new = $_POST['id_sub'];
    $id_kriteria = $_POST['id_kriteria'];
    $deskripsi = $_POST['deskripsi'];
    $nilai = $_POST['nilai'];

    // update dengan id baru
    $stmt = $pdo->prepare("UPDATE tb_sub_kriteria 
        SET id_sub=?, id_kriteria=?, deskripsi=?, nilai=? 
        WHERE id_sub_kriteria=?");
    $stmt->execute([$id_sub_new, $id_kriteria, $deskripsi, $nilai, $id]);

    header('Location: ../admin/sub_kriteria.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Sub Kriteria - Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header><h1>Edit Sub Kriteria</h1></header>
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
            <h2>Edit Sub Kriteria</h2>
            <form method="POST">
                <label>ID Sub Kriteria</label>
                <input type="text" name="id_sub" value="<?= htmlspecialchars($sub['id_sub']) ?>" required>

                <label>Kriteria</label>
                <select name="id_kriteria" required>
                    <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id_kriteria'] ?>" <?= $k['id_kriteria']==$sub['id_kriteria']?'selected':'' ?>><?= $k['nama_kriteria'] ?></option>
                    <?php endforeach ?>
                </select>

                <label>Deskripsi</label>
                <input type="text" name="deskripsi" value="<?= htmlspecialchars($sub['deskripsi']) ?>" required>

                <label>Nilai</label>
                <input type="number" step="0.01" name="nilai" value="<?= htmlspecialchars($sub['nilai']) ?>" required>

                <button type="submit">Simpan Perubahan</button>
            </form>
            <a href="../admin/sub_kriteria.php" class="back-btn">BACK</a>
        </main>
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Ambil semua data sub kriteria JOIN dengan kriteria
$stmt = $pdo->query("
    SELECT s.*, k.nama_kriteria 
    FROM tb_sub_kriteria s
    JOIN tb_kriteria k ON s.id_kriteria = k.id_kriteria
    ORDER BY s.id_kriteria, s.id_sub
");
$subs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sub Kriteria - Admin SPK Gizi Balita</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header>
        <div class="logo">
        <img src="../img/pus.png" alt="logo">
    </div>
        <h1>Admin - SPK Gizi Balita</h1>
        <div class="logo2">
        <img src="../img/logo_dinkes.png" alt="logo">
    </div>
    </header>
    <div class="container">
        <button class="hamburger">&#9776;</button> <!-- ini icon ☰ -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="../admin/index.php">HOME</a></li>
                    <li><a href="../admin/balita.php">Balita</a></li>
                    <li><a href="user.php">Data User</a></li>
                    <li><a href="kriteria.php">Data Kriteria</a></li>
                    <li><a href="sub_kriteria.php">Data Sub Kriteria</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content1">
            <h3>Data Sub Kriteria</h3>
            <a href="../admin/tambah_sub_kriteria.php" class="add-btn1">+ Tambah Sub Kriteria</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Deskripsi</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($subs as $sub): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($sub['nama_kriteria']) ?></td>
                        <td><?= htmlspecialchars($sub['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($sub['nilai']) ?></td>
                        <td class="action-buttons">
                            <a href="../admin/edit_sub_kriteria.php?id=<?= $sub['id_sub'] ?>" class="edit-btn">Edit</a>
                            <a href="../admin/hapus_sub_kriteria.php?id=<?= $sub['id_sub'] ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </main>
    </div>
    <script src="../assets/script.js"></script>
</body>
</html>

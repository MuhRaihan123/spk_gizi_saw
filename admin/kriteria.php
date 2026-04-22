<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Ambil semua data kriteria
$stmt = $pdo->query("SELECT * FROM tb_kriteria");
$kriteria = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kriteria - Admin SPK Gizi Balita</title>
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
            <h3>Data Kriteria</h3>
            <a href="../admin/tambah_kriteria.php" class="add-btn1">+ Tambah Kriteria</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Sifat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kriteria as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['kode_kriteria']) ?></td>
                        <td><?= htmlspecialchars($row['nama_kriteria']) ?></td>
                        <td><?= htmlspecialchars($row['bobot']) ?></td>
                        <td><?= htmlspecialchars($row['sifat']) ?></td>
                        <td class="action-buttons">
                            <a href="../admin/edit_kriteria.php?id=<?= $row['id_kriteria'] ?>" class="edit-btn">Edit</a>
                            <a href="../admin/hapus_kriteria.php?id=<?= $row['id_kriteria'] ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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

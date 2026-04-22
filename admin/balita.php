<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: .../login.php');
    exit;
}

require '../koneksi.php';

// ambil semua data
$stmt = $pdo->query("SELECT * FROM tb_alternatif");
$data_alternatif = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - SPK Gizi Balita</title>
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
        <main class="content">
            <div class="balita">
                <h2>Data Balita</h2>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari nama balita...">
                <a href="../tambah.php" class="add-btn">+ Tambah Balita</a>
                <a href="../admin/konversi.php" class="add-btn">CONVERT</a>
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th>Tinggi</th>
                            <th>Berat</th>
                            <th>Tinggi Lahir</th>
                            <th>Berat Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data_alternatif as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td><?= htmlspecialchars($row['usia_tahun']) ?></td>
                            <td><?= htmlspecialchars($row['tinggi']) ?></td>
                            <td><?= htmlspecialchars($row['berat']) ?></td>
                            <td><?= htmlspecialchars($row['tinggi_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['berat_lahir']) ?></td>
                            <td class="action-buttons">
                                <a href="../edit.php?id=<?= $row['kode_alternatif'] ?>" class="edit-btn">Edit</a>
                                <a href="../hapus.php?id=<?= $row['kode_alternatif'] ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
<script src="../assets/scripts.js"></script>
<script src="../assets/script.js"></script>
</body>
</html>

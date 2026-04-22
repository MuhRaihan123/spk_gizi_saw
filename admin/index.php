<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SPK Gizi Balita</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        .flex-container {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    justify-content: space-between;
    margin-top: 20px;
}

.left-box, .right-box {
    flex: 1;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.left-box h2, .right-box h2 {
    margin-top: 0;
}

@media (max-width: 768px) {
    .flex-container {
        flex-direction: column;
    }
}
.right-box ul {
    list-style: none;
    padding: 0;
}
.right-box li {
    background: #f1f1f1;
    margin-bottom: 8px;
    padding: 10px;
    border-radius: 5px;
}
.right-box li strong {
    color: #555;
}

    </style>
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
    <div class="flex-container">
    <div class="left-box">
        <h2>Visi</h2>
        <p>Menjadi Puskesmas yang Inovatif dan Responsif dalam pelayanan Kesehatan berbasis pada kebutuhan masyarakat untuk mewujudkan Kesehatan yang optimal bagi seluruh anggota keluarga.</p>

        <h2>Misi</h2>
        <p>Menyediakan layanan kesehatan yang komprehensif dan berkualitas tinggi kepada masyarakat termasuk pemeriksaan kesehatan, imunisasi, dan penyuluhan gizi.</p>
    </div>
    <div class="right-box">
    <h2>Aktivitas Terbaru</h2>
    <ul>
    <?php
    $stmt = $pdo->query("SELECT * FROM log_activity ORDER BY tanggal DESC LIMIT 10");
    while ($log = $stmt->fetch()) {
        echo "<li><strong>" . htmlspecialchars($log['tanggal']) . "</strong> - " 
           . htmlspecialchars($log['user']) . ": " 
           . htmlspecialchars($log['aktivitas']) . "</li>";
    }
    ?>
    </ul>
</div>
</div>
</main>
</div>
    <script src="../assets/script.js"></script>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - SPK Gizi Balita</title>
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
    <button class="hamburger">&#9776;</button> <!-- ini icon ☰ -->
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
            <div class="gambar">
                <h2>IBU DAN BALITA</h2>
            <img src="img/ibu_balita.jpeg" alt="gambar">
    </div>
            <div class="describt">
                <h2>Bersama Puskesmas, Wujudkan Ibu Sehat & Balita Hebat<br>
                    Kesehatan ibu dan anak adalah kunci masa depan yang cerah. <br>
                    Melalui layanan pemantauan status gizi di Puskesmas, kami hadir mendampingi setiap langkah tumbuh kembang balita dan menjaga kesehatan ibu dengan penuh perhatian dan kasih<br>
                    Website ini menyediakan informasi gizi yang akurat, pencatatan status gizi balita dan ibu secara berkala, serta panduan praktis untuk mendukung Anda dalam menciptakan keluarga yang sehat dan kuat.<br>

                    💖 Karena setiap ibu berhak mendapatkan dukungan, dan setiap anak berhak tumbuh sehat.<br> 
                    Bersama Puskesmas, mari kita bangun generasi yang lebih sehat, cerdas, dan sejahtera.</h2>
            </div>
        </main>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>

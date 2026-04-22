<?php
$host = 'localhost'; // atau 'localhost'
$db   = 'spk_gizi_balita';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
    // Jika mau debug sukses
    // echo "Koneksi berhasil!";
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>

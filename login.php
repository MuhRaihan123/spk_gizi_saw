<?php
session_start();
require 'koneksi.php'; // pastikan koneksi PDO ke $pdo

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM tb_user WHERE username = ? AND password = MD5(?) LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        session_regenerate_id(true);
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        // catat aktivitas login
        $nama_user = $user['username'];
        $pdo->prepare("INSERT INTO log_activity (user, aktivitas) VALUES (?, ?)")
            ->execute([$nama_user, 'Login ke sistem']);

        if ($user['role'] == 'admin') {
            header('Location: admin/index.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Gizi Balita</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="login-page">
    <header>
    <div class="logo">
        <img src="img/pus.png" alt="logo">
    </div>
    <h1>Sistem Pendukung Keputusan Gizi Balita</h1>
    <div class="logo2">
        <img src="img/logo_dinkes.png" alt="logo">
    </div>
    </header>
    <div class="login-content">
        <div class="login-left">
            <p>Selamat datang di aplikasi Sistem Pendukung Keputusan untuk menilai status gizi balita menggunakan metode SAW. 
            Silakan login untuk mengelola data dan melihat hasil rekomendasi.</p>
        </div>
        <div class="login-right">
            <h2>Login</h2>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

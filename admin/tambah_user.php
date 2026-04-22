<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO tb_user (username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $role]);

    header('Location: ../admin/user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User - Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header><h1>Tambah User</h1></header>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="../admin/index.php">Dashboard</a></li>
                    <li><a href="../admin/balita.php">Balita</a></li>
                    <li><a href="user.php">Data User</a></li>
                    <li><a href="kriteria.php">Data Kriteria</a></li>
                    <li><a href="sub_kriteria.php">Data Sub Kriteria</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <h2>Tambah User</h2>
            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <label>Level</label>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

                <button type="submit">Simpan</button>
            </form>
            <a href="../admin/user.php" class="back-btn">BACK</a>
        </main>
    </div>
</body>
</html>

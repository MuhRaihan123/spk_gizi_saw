<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tb_user WHERE id_user = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die("User tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $role = $_POST['role'];

    // update tanpa ganti password
    $pdo->prepare("UPDATE tb_user SET username=?, role=? WHERE id_user=?")
        ->execute([$username, $role, $id]);

    header('Location: ../admin/user.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User - Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <header><h1>Edit User</h1></header>
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
            <h2>Edit User</h2>
            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

                <label>role</label>
                <select name="level" required>
                    <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                    <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                </select>

                <button type="submit">Simpan Perubahan</button>
            </form>
            <a href="../admin/user.php" class="back-btn">BACK</a>
        </main>
    </div>
</body>
</html>

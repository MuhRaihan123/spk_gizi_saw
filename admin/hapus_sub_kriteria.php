<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM tb_sub_kriteria WHERE id_sub_kriteria=?");
$stmt->execute([$id]);

header('Location: ../admin/sub_kriteria.php');
exit;
?>

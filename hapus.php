<?php
session_start(); // WAJIB sebelum akses $_SESSION

require 'koneksi.php';

$id = $_GET['id'] ?? 0;

// cek data
$stmt = $pdo->prepare("SELECT * FROM tb_alternatif WHERE kode_alternatif=?");
$stmt->execute([$id]);
$balita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$balita) die("Data tidak ditemukan");

$kode_alternatif = $balita['kode_alternatif'];

// log aktivitas HANYA jika variabel sudah ada
$pdo->prepare("INSERT INTO log_activity (user, aktivitas) VALUES (?, ?)")
    ->execute([$_SESSION['username'], "Menghapus data balita dengan kode $kode_alternatif"]);

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // hapus data di tb_hitung
    $stmt = $pdo->prepare("DELETE FROM tb_hitung WHERE kode_alternatif = ?");
    $stmt->execute([$kode_alternatif]);

    // hapus data di tb_hasil
    $stmt = $pdo->prepare("DELETE FROM tb_hasil WHERE kode_alternatif = ?");
    $stmt->execute([$kode_alternatif]);

    // hapus data di tb_alternatif
    $stmt = $pdo->prepare("DELETE FROM tb_alternatif WHERE kode_alternatif = ?");
    $stmt->execute([$kode_alternatif]);

    // update ranking
    $stmt = $pdo->query("SELECT id_hasil FROM tb_hasil ORDER BY nilai_akhir DESC");
    $hasil_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $rank = 1;
    foreach ($hasil_data as $row) {
        $stmt = $pdo->prepare("UPDATE tb_hasil SET ranking = ? WHERE id_hasil = ?");
        $stmt->execute([$rank++, $row['id_hasil']]);
    }

    header("Location: balita.php");
    exit;
}
?>

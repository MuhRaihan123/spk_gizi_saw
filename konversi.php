<?php
require 'koneksi.php';

// Kosongkan dulu tb_hitung
$pdo->query("TRUNCATE TABLE tb_hitung");

// Ambil data balita dari tb_alternatif
$stmt = $pdo->query("SELECT * FROM tb_alternatif");
$alternatif = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($alternatif as $alt) {
    $kode = $alt['kode_alternatif'];
    $jk = $alt['jenis_kelamin']; // sudah "Laki-laki" atau "Perempuan"

    // Konversi sesuai tb_sub_kriteria
    $usia_nilai = cariNilai($pdo, 1, usiaKeTahun($alt['usia_tahun']));
    $berat_lahir_nilai = cariNilai($pdo, 2, $alt['berat_lahir']);
    $tinggi_lahir_nilai = cariNilai($pdo, 3, $alt['tinggi_lahir']);
    $berat_nilai = cariNilai($pdo, 4, $alt['berat'], $jk);
    $tinggi_nilai = cariNilai($pdo, 5, $alt['tinggi'], $jk);

    // Insert ke tb_hitung
    $stmt_insert = $pdo->prepare("INSERT INTO tb_hitung 
        (kode_alternatif, usia_tahun, tinggi, berat, tinggi_lahir, berat_lahir) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert->execute([
        $kode, $usia_nilai, $tinggi_nilai, $berat_nilai, $tinggi_lahir_nilai, $berat_lahir_nilai
    ]);
}

// Setelah selesai langsung redirect
header("Location: balita.php");
exit;

// ===================
// FUNGSI BANTUAN
// ===================
function usiaKeTahun($usia) {
    if (stripos($usia, 'bulan') !== false) {
        return intval($usia) / 12;
    } else {
        return intval($usia);
    }
}

function cariNilai($pdo, $id_kriteria, $angka, $jk = null) {
    $stmt = $pdo->prepare("SELECT deskripsi, nilai FROM tb_sub_kriteria WHERE id_kriteria=? ORDER BY id_sub");
    $stmt->execute([$id_kriteria]);

    foreach ($stmt as $row) {
        $des = $row['deskripsi'];
        $nilai = $row['nilai'];

        // Jika ada Laki-laki / Perempuan pastikan hanya ambil sesuai JK
        if ($jk) {
            if (stripos($des, $jk) === false && (stripos($des, 'Laki-laki') !== false || stripos($des, 'Perempuan') !== false)) {
                continue;
            }
        }

        // Cek range "x - y"
        if (preg_match('/([0-9]+(\.[0-9]+)?)\s*-\s*([0-9]+(\.[0-9]+)?)/', $des, $m)) {
            $min = floatval($m[1]);
            $max = floatval($m[3]);
            if ($angka >= $min && $angka <= $max) {
                return $nilai;
            }
        }
        // Cek "< x"
        elseif (preg_match('/<\s*([0-9]+(\.[0-9]+)?)/', $des, $m)) {
            if ($angka < floatval($m[1])) {
                return $nilai;
            }
        }
        // Cek "> x"
        elseif (preg_match('/>\s*([0-9]+(\.[0-9]+)?)/', $des, $m)) {
            if ($angka > floatval($m[1])) {
                return $nilai;
            }
        }
    }

    // Jika tidak menemukan, ambil nilai terendah
    $stmt2 = $pdo->prepare("SELECT MIN(nilai) as min_nilai FROM tb_sub_kriteria WHERE id_kriteria=?");
    $stmt2->execute([$id_kriteria]);
    $rowMin = $stmt2->fetch();
    echo "<p style='color:red'>⚠️ Tidak menemukan nilai untuk angka=$angka kriteria=$id_kriteria JK=$jk. Ambil nilai minimum: ".$rowMin['min_nilai']."</p>";
    return $rowMin ? $rowMin['min_nilai'] : 0;
}
?>

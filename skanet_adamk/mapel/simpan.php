<?php
include "../koneksi.php";

$id_mapel   = $_POST['id_mapel'];
$nama_mapel = $_POST['nama_mapel'];
$guru       = $_POST['guru'];

// Menjalankan query
$query = mysqli_query($koneksi, "INSERT INTO mapel (id_mapel, nama_mapel, guru)
VALUES ('$id_mapel', '$nama_mapel', '$guru')");

// Cek apakah query berhasil dijalankan
if ($query) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
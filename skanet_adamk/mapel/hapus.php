<?php
include "../koneksi.php";

// Mengambil id_mapel dari URL
$id_mapel = $_POST['id_mapel'] ?? $_GET['id_mapel'];

// Menghapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM mapel WHERE id_mapel='$id_mapel'");

// Redirect kembali ke halaman index.php setelah berhasil hapus
if ($query) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
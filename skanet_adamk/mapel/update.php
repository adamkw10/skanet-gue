<?php
include "../koneksi.php";

$id_mapel   = $_POST['id_mapel'];
$nama_mapel = $_POST['nama_mapel'];
$guru       = $_POST['guru'];

$query = mysqli_query($koneksi, "UPDATE mapel
SET
    nama_mapel='$nama_mapel',
    guru='$guru'
WHERE id_mapel='$id_mapel'");

if($query){
    header("Location: index.php");
    exit();
}else{
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
?>
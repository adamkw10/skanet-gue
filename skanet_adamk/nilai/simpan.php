<?php
include "koneksi.php";

$nis      = $_POST['nis'];
$nip      = $_POST['nip'];
$id_mapel = $_POST['id_mapel'];
$nilai    = $_POST['nilai'];

// Menyimpan ke tabel 'nilai'
$query = mysqli_query($koneksi, "INSERT INTO nilai (nis, nip, id_mapel, nilai) VALUES ('$nis', '$nip', '$id_mapel', '$nilai')");

header('location:index.php');
?>
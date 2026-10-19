<?php

include "koneksi.php";

session_start();

if(!isset($_SESSION['status']) || $_SESSION['status']!="sukses"){
    header("location:logout.php");
    exit;
}

$id_nilai=$_GET['id_nilai'];

$query=mysqli_query($koneksi,"SELECT * FROM nilai WHERE id_nilai='$id_nilai'");

$data=mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Data Nilai</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>

body{
    background:#e8f5e9;
    font-family:'Segoe UI',sans-serif;
}

/* Header */

.header{
    background:linear-gradient(90deg,#2e7d32,#43a047);
    color:white;
    padding:30px 0;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,.2);
}

.header h2{
    margin:0;
    font-weight:bold;
}

/* Card */

.card-form{
    background:white;
    max-width:600px;
    margin:40px auto;
    padding:35px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

/* Label */

.form-label{
    color:#2e7d32;
    font-weight:600;
}

/* Input */

.form-control{
    border-radius:12px;
    padding:12px;
}

.form-control:focus{
    border-color:#43a047;
    box-shadow:0 0 8px rgba(67,160,71,.3);
}

/* Tombol */

.btn-hijau{
    background:#2e7d32;
    color:white;
    font-weight:600;
    border:none;
}

.btn-hijau:hover{
    background:#1b5e20;
    color:white;
    transform:translateY(-2px);
    transition:.3s;
}

/* Footer */

.footer{
    text-align:center;
    color:#666;
    margin-top:20px;
    font-size:14px;
}

</style>

</head>

<body>

<div class="header">

<h2>
<i class="bi bi-bar-chart-fill"></i>
Edit Data Nilai
</h2>

<p class="mb-0">
Sistem Informasi Sekolah
</p>

</div>

<div class="container">

<div class="card-form">

<form action="update.php" method="POST"
onsubmit="return confirm('Apakah kamu yakin ingin menyimpan perubahan data nilai ini?');">

<input type="hidden"
name="id_nilai"
value="<?= htmlspecialchars($data['id_nilai']); ?>">

<div class="mb-3">

<label class="form-label">
ID Mapel
</label>

<input type="text"
name="id_mapel"
class="form-control"
value="<?= htmlspecialchars($data['id_mapel']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
NIS Siswa
</label>

<input type="text"
name="nis"
class="form-control"
value="<?= htmlspecialchars($data['nis']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
NIP Guru
</label>

<input type="text"
name="nip"
class="form-control"
value="<?= htmlspecialchars($data['nip']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">
Nilai
</label>

<input type="text"
name="nilai"
class="form-control"
value="<?= htmlspecialchars($data['nilai']); ?>"
required>

</div>

<div class="d-flex justify-content-between">

<a href="index.php" class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

<button type="submit" class="btn btn-hijau">

<i class="bi bi-save"></i>

Simpan

</button>

</div>

</form>

</div>

<div class="footer">

© 2026 Sistem Informasi Sekolah

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
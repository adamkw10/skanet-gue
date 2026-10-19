
<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['status']) || $_SESSION['status']!="sukses"){
    header("location:../logout.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Nilai</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<style>

body{
    background:#e8f5e9;
    font-family:'Segoe UI',sans-serif;
}


/* NAVBAR */

.navbar{
    background:linear-gradient(90deg,#1b5e20,#2e7d32);
    box-shadow:0 3px 10px rgba(0,0,0,.2);
}

.navbar-brand{
    font-weight:bold;
    color:white !important;
}

.navbar-brand i{
    margin-right:8px;
}

.nav-link{
    color:white !important;
    font-weight:500;
    margin-left:5px;
    border-radius:8px;
    padding:8px 12px !important;
    transition:.3s;
}

.nav-link:hover{
    background:#43a047;
    color:white !important;
}

.nav-link.active{
    background:#43a047;
    color:white !important;
}

.nav-link i{
    margin-right:5px;
}


/* HEADER */

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

.header p{
    margin-top:8px;
    margin-bottom:0;
}


/* CARD */

.card-data{
    background:white;
    border-radius:20px;
    margin:40px auto;
    padding:30px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}


/* TOMBOL */

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


/* TABEL */

.table thead{
    background:#2e7d32;
    color:white;
}

.table tbody tr{
    transition:.3s;
}

.table tbody tr:hover{
    background:#f1f8e9;
}


/* TOMBOL AKSI */

.btn-warning,
.btn-danger{
    transition:.3s;
}

.btn-warning:hover,
.btn-danger:hover{
    transform:scale(1.05);
}


/* FOOTER */

.footer{
    text-align:center;
    color:#666;
    margin:20px 0;
    font-size:14px;
}

</style>


</head>


<body>


<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg">

    <div class="container">


        <a class="navbar-brand" href="../index.php">

            <i class="bi bi-mortarboard-fill"></i>

            Sistem Informasi Sekolah

        </a>


        <button class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto">


                <!-- DATA SISWA -->

                <li class="nav-item">

                    <a class="nav-link" href="../siswa">

                        <i class="bi bi-people-fill"></i>

                        Data Siswa

                    </a>

                </li>


                <!-- DATA GURU -->

                <li class="nav-item">

                    <a class="nav-link" href="../guru">

                        <i class="bi bi-person-badge-fill"></i>

                        Data Guru

                    </a>

                </li>


                <!-- MATA PELAJARAN -->

                <li class="nav-item">

                    <a class="nav-link" href="../mapel">

                        <i class="bi bi-book-fill"></i>

                        Mata Pelajaran

                    </a>

                </li>


                <!-- DATA NILAI -->

                <li class="nav-item">

                    <a class="nav-link active" href="index.php">

                        <i class="bi bi-bar-chart-fill"></i>

                        Data Nilai

                    </a>

                </li>


                <!-- LOGOUT -->

                <li class="nav-item">

                    <a class="nav-link" href="../logout.php">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </a>

                </li>


            </ul>

        </div>

    </div>

</nav>



<!-- HEADER -->

<div class="header">

    <h2>

        <i class="bi bi-bar-chart-fill"></i>

        Data Nilai Siswa

    </h2>


    <p>

        Selamat Datang,

        <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>

    </p>

</div>



<!-- CONTENT -->

<div class="container">

    <div class="card-data">


        <div class="d-flex justify-content-between mb-4">


            <a href="tambah.php" class="btn btn-hijau">

                <i class="bi bi-plus-circle"></i>

                Tambah Data

            </a>


            <a href="../index.php" class="btn btn-secondary">

                <i class="bi bi-house-door-fill"></i>

                Menu Utama

            </a>


        </div>



        <div class="table-responsive">


            <table class="table table-bordered table-hover text-center align-middle">


                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama Siswa</th>

                        <th>Nama Mapel</th>

                        <th>Nama Guru</th>

                        <th>Nilai</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>



                <tbody>


                <?php

                $no = 1;

                $query = mysqli_query($koneksi, "

                    SELECT
                        nilai.*,
                        siswa.nama AS nama_siswa,
                        mapel.nama_mapel,
                        guru.nama AS nama_guru

                    FROM nilai

                    JOIN siswa
                    ON nilai.nis = siswa.nis

                    JOIN mapel
                    ON nilai.id_mapel = mapel.id_mapel

                    JOIN guru
                    ON nilai.nip = guru.nip

                ");


                while($data = mysqli_fetch_assoc($query)){

                ?>


                <tr>


                    <td>
                        <?= $no++; ?>
                    </td>


                    <td>
                        <?= htmlspecialchars($data['nama_siswa']); ?>
                    </td>


                    <td>
                        <?= htmlspecialchars($data['nama_mapel']); ?>
                    </td>


                    <td>
                        <?= htmlspecialchars($data['nama_guru']); ?>
                    </td>


                    <td>

                        <span class="badge bg-success fs-6">

                            <?= htmlspecialchars($data['nilai']); ?>

                        </span>

                    </td>


                    <td>


                        <a href="edit.php?id_nilai=<?= urlencode($data['id_nilai']); ?>"
                           class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil-square"></i>

                            Edit

                        </a>


                        <a href="hapus.php?id_nilai=<?= urlencode($data['id_nilai']); ?>"

                           class="btn btn-danger btn-sm"

                           onclick="return confirm('Yakin ingin menghapus data ini?')">

                            <i class="bi bi-trash"></i>

                            Hapus

                        </a>


                    </td>


                </tr>


                <?php } ?>


                </tbody>


            </table>


        </div>


    </div>



    <div class="footer">

        © 2026 Sistem Informasi Sekolah

    </div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```

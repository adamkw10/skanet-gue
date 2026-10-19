
<?php
session_start();

if(!isset($_SESSION['status']) || $_SESSION['status']!="sukses"){
    header("location:logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Menu Utama</title>

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

.nav-link i{
    margin-right:5px;
}

/* HEADER */
.header{
    background:linear-gradient(90deg,#2e7d32,#43a047);
    color:white;
    padding:35px 0;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,.2);
}

.header h2{
    font-weight:bold;
}

/* MENU CARD */
.menu-card{
    background:white;
    border-radius:20px;
    padding:30px;
    margin-top:-40px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.menu-btn{
    display:flex;
    align-items:center;
    gap:15px;
    text-decoration:none;
    color:#2e7d32;
    background:#f8f9fa;
    padding:18px;
    border-radius:15px;
    margin-bottom:15px;
    transition:.3s;
    font-weight:600;
    font-size:18px;
}

.menu-btn:hover{
    background:#43a047;
    color:white;
    transform:translateX(8px);
}

.menu-btn i{
    font-size:28px;
}

.logout{
    background:#dc3545;
    color:white;
}

.logout:hover{
    background:#b71c1c;
}

/* FOOTER */
.footer{
    text-align:center;
    color:#666;
    margin-top:30px;
    font-size:14px;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand" href="index.php">
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
                    <a class="nav-link" href="siswa">
                        <i class="bi bi-people-fill"></i>
                        Data Siswa
                    </a>
                </li>

                <!-- DATA GURU -->
                <li class="nav-item">
                    <a class="nav-link" href="guru">
                        <i class="bi bi-person-badge-fill"></i>
                        Data Guru
                    </a>
                </li>

                <!-- MATA PELAJARAN -->
                <li class="nav-item">
                    <a class="nav-link" href="mapel">
                        <i class="bi bi-book-fill"></i>
                        Mata Pelajaran
                    </a>
                </li>

                <!-- DATA NILAI -->
                <li class="nav-item">
                    <a class="nav-link" href="nilai">
                        <i class="bi bi-bar-chart-fill"></i>
                        Data Nilai
                    </a>
                </li>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
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
        <i class="bi bi-mortarboard-fill"></i>
        Sistem Informasi Sekolah
    </h2>

    <p class="mb-0">
        Selamat Datang,
        <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>
    </p>

</div>


<!-- CONTENT -->
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="menu-card">

                <h4 class="text-center text-success mb-4">
                    Menu Utama
                </h4>

                <a href="siswa" class="menu-btn">
                    <i class="bi bi-people-fill"></i>
                    Data Siswa
                </a>

                <a href="guru" class="menu-btn">
                    <i class="bi bi-person-badge-fill"></i>
                    Data Guru
                </a>

                <a href="mapel" class="menu-btn">
                    <i class="bi bi-book-fill"></i>
                    Mata Pelajaran
                </a>

                <a href="nilai" class="menu-btn">
                    <i class="bi bi-bar-chart-fill"></i>
                    Data Nilai
                </a>

                <hr>

                <a href="logout.php" class="menu-btn logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>

            </div>

            <div class="footer">
                © 2026 Sistem Informasi Sekolah
            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


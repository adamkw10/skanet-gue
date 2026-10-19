```php
<?php
session_start();

require_once __DIR__ . "/koneksi.php";

// =========================================
// CEK KONEKSI DATABASE
// =========================================

if (!isset($koneksi) || !$koneksi) {
    die("Koneksi database gagal. Periksa file koneksi.php.");
}

// =========================================
// CEK SESSION LOGIN
// =========================================

if (
    isset($_SESSION['status']) &&
    $_SESSION['status'] === "sukses"
) {
    header("Location: index.php");
    exit;
}

// =========================================
// PROSES LOGIN
// =========================================

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {

        $error = "Username dan password wajib diisi.";

    } else {

        $stmt = mysqli_prepare(
            $koneksi,
            "SELECT username, password
             FROM users
             WHERE username = ?
             LIMIT 1"
        );

        if (!$stmt) {

            $error = "Query login gagal. Periksa struktur tabel users.";

        } else {

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if (!$user) {

                $error = "Username tidak ditemukan di database.";

            } else {

                $dbPassword = (string) $user['password'];

                // Periksa password hash
                $valid = password_verify(
                    $password,
                    $dbPassword
                );

                // Password teks biasa untuk database lama
                if (!$valid && hash_equals(
                    $dbPassword,
                    $password
                )) {
                    $valid = true;
                }

                // Password MD5 untuk database lama
                if (!$valid && preg_match(
                    '/^[a-f0-9]{32}$/i',
                    $dbPassword
                )) {
                    $valid = hash_equals(
                        strtolower($dbPassword),
                        md5($password)
                    );
                }

                // Password SHA-1 untuk database lama
                if (!$valid && preg_match(
                    '/^[a-f0-9]{40}$/i',
                    $dbPassword
                )) {
                    $valid = hash_equals(
                        strtolower($dbPassword),
                        sha1($password)
                    );
                }

                if ($valid) {

                    session_regenerate_id(true);

                    $_SESSION['status'] = "sukses";
                    $_SESSION['username'] = $user['username'];

                    // Arahkan ke index.php
                    header("Location: index.php");
                    exit;

                } else {

                    $error = "Password tidak cocok dengan akun tersebut.";

                }
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Sistem</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(
        135deg,
        #1b5e20,
        #43a047,
        #a5d6a7
    );
}

.login-card {
    width: 100%;
    max-width: 420px;
    background: white;
    padding: 35px;
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
    animation: naik .8s ease;
}

@keyframes naik {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.logo {
    text-align: center;
    color: #2e7d32;
    font-size: 45px;
}

.judul {
    text-align: center;
    color: #2e7d32;
    font-weight: bold;
    margin-bottom: 25px;
}

.form-label {
    color: #2e7d32;
    font-weight: 600;
}

.form-control {
    border-radius: 12px;
    padding: 12px;
}

.form-control:focus {
    border-color: #43a047;
    box-shadow: 0 0 8px rgba(67,160,71,.4);
}

.btn-login {
    width: 100%;
    background: #2e7d32;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 12px;
    font-weight: bold;
    font-size: 17px;
}

.btn-login:hover {
    background: #1b5e20;
    color: white;
    transform: scale(1.03);
    transition: .3s;
}

.footer {
    text-align: center;
    color: #777;
    margin-top: 20px;
    font-size: 14px;
}

</style>

</head>

<body>

<div class="login-card">

    <div class="logo">
        <i class="bi bi-shield-lock-fill"></i>
    </div>

    <h2 class="judul">
        LOGIN SISTEM
    </h2>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger mt-3 text-center">
            <?= htmlspecialchars(
                $error,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">

        <div class="mb-3">

            <label for="username" class="form-label">
                Username
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-person-fill"></i>
                </span>

                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                >

            </div>

        </div>

        <div class="mb-3">

            <label for="password" class="form-label">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="bi bi-key-fill"></i>
                </span>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

            </div>

        </div>

        <button
            type="submit"
            name="login"
            class="btn-login"
        >
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </button>

    </form>

    <div class="footer">
        &copy; <?= date('Y') ?> Sistem Informasi Sekolah
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
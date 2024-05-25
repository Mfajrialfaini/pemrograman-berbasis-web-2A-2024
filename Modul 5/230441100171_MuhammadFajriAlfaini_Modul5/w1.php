<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: error.php"); // Redirect ke halaman error jika belum login
    exit();
}

// Ambil nama pengguna dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "ALVEN";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "FAJRI";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Mahasiswa</title>
    <link rel="stylesheet" href="w1.css">
</head>
<body>
     
<nav>
    <ul class="navbar">
        <li><a href="#">Home</a></li>
        <li><a href="w1.php"> Web 1</a></li>
        <li><a href="Welcome.php"> Web 2</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>


    <div class="Home">
        <div class="Content">
           <h2>SELAMAT DATANG <?php echo htmlspecialchars($username); ?></h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2024 Daftar Hadir Mahasiswa</p>
    </footer>
</body>
</html>

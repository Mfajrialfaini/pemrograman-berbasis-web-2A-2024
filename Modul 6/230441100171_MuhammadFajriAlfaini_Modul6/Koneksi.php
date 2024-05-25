<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

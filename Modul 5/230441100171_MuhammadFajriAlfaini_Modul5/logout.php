<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php"); // Mengarahkan pengguna kembali ke halaman login
exit();
?>

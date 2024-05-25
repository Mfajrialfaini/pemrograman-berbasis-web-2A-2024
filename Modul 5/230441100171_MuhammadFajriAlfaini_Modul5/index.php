<?php
session_start();

$valid_users = [
    "ALVEN" => "12345",
    "FAJRI" => "12345"
];
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    // Periksa apakah nama pengguna dan kata sandi cocok
    if (isset($valid_users[$input_username]) && $valid_users[$input_username] === $input_password) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $input_username;
        header("Location: w1.php");
        exit();
    } else {
        $login_error = "Username atau password yang Anda masukkan salah.";
        header("Location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silakan Login Dahulu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="error-message"><?php echo $login_error; ?></div>
        </form>
    </div>
</body>
</html>

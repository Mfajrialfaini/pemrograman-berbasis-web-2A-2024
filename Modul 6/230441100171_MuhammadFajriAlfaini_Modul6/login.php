<?php
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $valid_username = 'alven';
    $valid_password = '12345';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header('Location: menu.php');
        exit();
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
            color: #333;
        }

        .input-group-custom {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group-custom label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 16px;
            color: #333;
            padding: 5px;
        }

        .input-group-custom input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 400;
            transition: border-color 0.3s;
        }

        .input-group-custom input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff0000;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <?php if (isset($error_message)): ?>
                <p class="error"><?= $error_message ?></p>
            <?php endif; ?>
            <div class="input-group input-group-custom">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="input-group input-group-custom">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-custom">Login</button>
        </form>
    </div>
</body>
</html>

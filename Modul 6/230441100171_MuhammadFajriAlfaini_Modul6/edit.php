<?php
require 'koneksi.php';

function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = sanitize($_GET['id']);
        $sql = "SELECT * FROM data WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Data tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID tidak diberikan.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = sanitize($_POST["id"]);
    $nama = sanitize($_POST["nama"]);
    $nim = sanitize($_POST["nim"]);
    $umur = sanitize($_POST["umur"]);
    $jenis_kelamin = sanitize($_POST["jenis_kelamin"]);
    $prodi = sanitize($_POST["prodi"]);
    $jurusan = sanitize($_POST["jurusan"]);
    $asal_kota = sanitize($_POST["asal_kota"]);

    $update_sql = "UPDATE data SET 
                   nama = '$nama', 
                   nim = '$nim', 
                   umur = '$umur', 
                   jenis_kelamin = '$jenis_kelamin', 
                   prodi = '$prodi', 
                   jurusan = '$jurusan', 
                   asal_kota = '$asal_kota' 
                   WHERE id = '$id'";

    if ($conn->query($update_sql) === TRUE) {
        header('Location: menu.php');
        exit;
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .container header {
            text-align: center;
            margin-bottom: 20px;
        }

        .container header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            margin-top: 10px;
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }

        .form-group input, .form-group textarea, .form-group select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: #007bff;
        }

        .form-group .input-icon {
            position: absolute;
            right: 10px;
            top: 40px;
            color: #aaa;
            transition: color 0.3s;
        }

        .form-group input:focus + .input-icon, .form-group textarea:focus + .input-icon, .form-group select:focus + .input-icon {
            color: #007bff;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            width: 100%;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="Alfy Kanaeru.png" alt="Logo">
        </header>
        <h2>Edit Data Mahasiswa</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row["nama"]) ?>" required />
                <i class="fas fa-user input-icon"></i>
            </div>
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($row["nim"]) ?>" required />
                <i class="fas fa-id-badge input-icon"></i>
            </div>
            <div class="form-group">
                <label>Umur:</label>
                <input type="number" name="umur" class="form-control" value="<?= htmlspecialchars($row["umur"]) ?>" required />
                <i class="fas fa-calendar-alt input-icon"></i>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" <?= $row["jenis_kelamin"] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $row["jenis_kelamin"] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
                <i class="fas fa-venus-mars input-icon"></i>
            </div>
            <div class="form-group">
                <label>Prodi:</label>
                <input type="text" name="prodi" class="form-control" value="<?= htmlspecialchars($row["prodi"]) ?>" required />
                <i class="fas fa-book input-icon"></i>
            </div>
            <div class="form-group">
                <label>Jurusan:</label>
                <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($row["jurusan"]) ?>" required />
                <i class="fas fa-chalkboard-teacher input-icon"></i>
            </div>
            <div class="form-group">
                <label>Asal Kota:</label>
                <input type="text" name="asal_kota" class="form-control" value="<?= htmlspecialchars($row["asal_kota"]) ?>" required />
                <i class="fas fa-city input-icon"></i>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>

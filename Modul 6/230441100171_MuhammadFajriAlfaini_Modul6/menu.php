<?php
require 'koneksi.php';

$sql = "SELECT * FROM data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container-custom {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            padding: 30px;
            max-width: 1200px;
            width: 100%;
        }

        .header-custom {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 700;
            color: #333;
        }

        .action-buttons-custom {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .action-buttons-custom a {
            margin-left: 10px;
        }

        .table-responsive-custom {
            margin-bottom: 20px;
        }

        .table-custom td {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table-custom td:last-child {
            text-align: center;
        }

        .btn-primary, .btn-secondary, .btn-warning, .btn-danger {
            font-weight: 700;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container container-custom">
        <h2 class="header-custom">Data Mahasiswa</h2>
        <div class="table-responsive table-responsive-custom">
            <table class="table table-striped table-bordered table-custom">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                        <th>Asal Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row["nama"]) ?></td>
                                <td><?= htmlspecialchars($row["nim"]) ?></td>
                                <td><?= htmlspecialchars($row["umur"]) ?></td>
                                <td><?= htmlspecialchars($row["jenis_kelamin"]) ?></td>
                                <td><?= htmlspecialchars($row["prodi"]) ?></td>
                                <td><?= htmlspecialchars($row["jurusan"]) ?></td>
                                <td><?= htmlspecialchars($row["asal_kota"]) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="action-buttons action-buttons-custom">
            <a href="tambah.php" class="btn btn-success">Tambah</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>

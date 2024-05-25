<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: error.php");
    exit();
}

// Ambil nama pengguna dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "ALVEN";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "FAJRI";

// Data hadir mahasiswa
$attendance = isset($_SESSION['attendance']) ? $_SESSION['attendance'] : [];

// Menginisialisasiakan variabel
$form_no = '';
$form_name = '';
$form_nim = '';
$form_jurusan = '';
$form_index = -1;

 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['add']) || isset($_POST['update']))) {
    $no = $_POST['no'];
    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    if ($no !== "" && $name !== "" && $nim !== "" && $jurusan !== "") {
        if (isset($_POST['add'])) {
            $attendance[] = ['no' => $no, 'name' => $name, 'nim' => $nim, 'jurusan' => $jurusan, 'finished' => false];
        } elseif (isset($_POST['update'])) {
            $index = $_POST['index'];
            $attendance[$index] = ['no' => $no, 'name' => $name, 'nim' => $nim, 'jurusan' => $jurusan, 'finished' => false];
        }
        $_SESSION['attendance'] = $attendance;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// edit Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $index = $_POST['index'];
    $form_no = $attendance[$index]['no'];
    $form_name = $attendance[$index]['name'];
    $form_nim = $attendance[$index]['nim'];
    $form_jurusan = $attendance[$index]['jurusan'];
    $form_index = $index;

    // Remove the entry being edited from the attendance array
    unset($attendance[$index]);
    $_SESSION['attendance'] = $attendance;
}

// Hapus data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $index = $_POST['index'];
    array_splice($attendance, $index, 1);
    $_SESSION['attendance'] = $attendance;
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Tandai selesai
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finish'])) {
    $index = $_POST['index'];
    $attendance[$index]['finished'] = !$attendance[$index]['finished'];
    $_SESSION['attendance'] = $attendance;
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Mahasiswa</title>
    <link rel="stylesheet" href="Welcome.css">
</head>
<body>
    <header>
        <h1>Daftar Hadir Mahasiswa</h1>
    </header>

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
      
    <div class="container">
        <h2>Masukkan Daftar hadir di sini</h2>
        <form action="" method="post">
            <input type="hidden" name="index" value="<?php echo $form_index; ?>">
            <input type="text" name="no" placeholder="No" value="<?php echo htmlspecialchars($form_no); ?>" required>
            <input type="text" name="name" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($form_name); ?>" required>
            <input type="text" name="nim" placeholder="NIM" value="<?php echo htmlspecialchars($form_nim); ?>" required>
            <input type="text" name="jurusan" placeholder="Jurusan" value="<?php echo htmlspecialchars($form_jurusan); ?>" required>
            <?php if ($form_index === -1): ?>
                <button type="submit" name="add">Tambah</button>
            <?php else: ?>
                <button type="submit" name="update">Update</button>
            <?php endif; ?>
        </form>
        <h2>Daftar Hadir</h2>

        <table id="attendance">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Edit</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendance as $index => $entry): ?>
                <tr class="<?php echo $entry['finished'] ? 'finished' : ''; ?>">
                    <td><?php echo htmlspecialchars($entry['no']); ?></td>
                    <td><?php echo htmlspecialchars($entry['name']); ?></td>
                    <td><?php echo htmlspecialchars($entry['nim']); ?></td>
                    <td><?php echo htmlspecialchars($entry['jurusan']); ?></td>
                    <td>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="edit">Edit</button>
                        </form>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="delete">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="finish"><?php echo $entry['finished'] ? 'Undo' : 'Selesai'; ?></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 Daftar Hadir Mahasiswa</p>
    </footer>
</body>
</html>

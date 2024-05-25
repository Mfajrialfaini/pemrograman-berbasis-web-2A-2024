<?php
require 'koneksi.php';

function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);

    $sql = "DELETE FROM data WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: menu.php');
        exit;
    } else {
        echo "Error saat menghapus rekaman: " . $conn->error;
    }
} else {
    echo "ID tidak diberikan.";
    exit;
}

$conn->close();
?>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori = $_POST['kategori'];
    $jumlah   = $_POST['jumlah'];
    $berat    = $_POST['berat'];

    $sql = "INSERT INTO data_tomat (kategori, jumlah_tomat, berat_kg) VALUES ('$kategori', '$jumlah', '$berat')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Data Berhasil Disimpan!";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>
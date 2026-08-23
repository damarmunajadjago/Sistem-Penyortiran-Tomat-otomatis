<?php
$conn = new mysqli("localhost", "root", "", "penyortiran_tomat");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$matang_jml   = intval($_POST['matang_jml']);
$matang_kg    = floatval($_POST['matang_kg']);

$setengah_jml = intval($_POST['setengah_jml']);
$setengah_kg  = floatval($_POST['setengah_kg']);

$mentah_jml   = intval($_POST['mentah_jml']);
$mentah_kg    = floatval($_POST['mentah_kg']);

$busuk_jml    = intval($_POST['busuk_jml']);
$busuk_kg     = floatval($_POST['busuk_kg']);

$waktu_sekarang = date('Y-m-d H:i:s');

$sql = "INSERT INTO sortir_tomat (kategori, jumlah_tomat, berat_kg, waktu) VALUES 
        ('matang', $matang_jml, $matang_kg, '$waktu_sekarang'),
        ('setengah matang', $setengah_jml, $setengah_kg, '$waktu_sekarang'),
        ('mentah', $mentah_jml, $mentah_kg, '$waktu_sekarang'),
        ('busuk', $busuk_jml, $busuk_kg, '$waktu_sekarang')";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
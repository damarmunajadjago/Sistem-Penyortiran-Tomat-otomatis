<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "penyortiran_tomat";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal"]));
}

// Menerima input JSON dari ESP32 Gateway
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['kategori']) && isset($data['jumlah_tomat']) && isset($data['berat_kg'])) {
    $kategori = $conn->real_escape_string($data['kategori']);
    $jumlah   = intval($data['jumlah_tomat']);
    $berat    = floatval($data['berat_kg']);

    $sql = "INSERT INTO sortir_tomat (kategori, jumlah_tomat, berat_kg) VALUES ('$kategori', $jumlah, $berat)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}

$conn->close();
?>
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("localhost", "root", "", "penyortiran_tomat");

// Ambil Ringkasan Per Kategori
$summaryQuery = "SELECT 
    kategori, 
    SUM(jumlah_tomat) as total_jumlah, 
    SUM(berat_kg) as total_berat 
    FROM sortir_tomat 
    GROUP BY kategori";

$summaryResult = $conn->query($summaryQuery);
$summary = [
    'matang' => ['jumlah' => 0, 'berat' => 0],
    'setengah matang' => ['jumlah' => 0, 'berat' => 0],
    'mentah' => ['jumlah' => 0, 'berat' => 0],
    'busuk' => ['jumlah' => 0, 'berat' => 0]
];

while ($row = $summaryResult->fetch_assoc()) {
    $kat = strtolower($row['kategori']);
    if (isset($summary[$kat])) {
        $summary[$kat]['jumlah'] = intval($row['total_jumlah']);
        $summary[$kat]['berat']  = floatval($row['total_berat']);
    }
}

// Ambil 10 Riwayat Terakhir
$historyQuery = "SELECT * FROM sortir_tomat ORDER BY ID DESC LIMIT 10";
$historyResult = $conn->query($historyQuery);
$history = [];

while ($row = $historyResult->fetch_assoc()) {
    $history[] = $row;
}

echo json_encode([
    'summary' => $summary,
    'history' => $history
]);

$conn->close();
?>
<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

// JSON beolvasás
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data || !isset($data["id"])) {
    echo json_encode([
        "success" => false,
        "error" => "Nincs adat",
        "raw" => $raw,
        "data" => $data
    ]);
    exit;
}

$hozzavaloID = intval($data["id"]);

// VALIDÁLÁS
if ($hozzavaloID <= 0) {
    echo json_encode([
        "success" => false,
        "error" => "Hibás ID"
    ]);
    exit;
}

// UPDATE (soft delete)
$sql = "UPDATE hozzavalo SET Torolve = 1 WHERE HozzavaloID = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $hozzavaloID);

if (!$stmt->execute()) {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
    exit;
}

// SIKER
echo json_encode([
    "success" => true,
    "affected_rows" => $stmt->affected_rows,
    "id" => $hozzavaloID
]);
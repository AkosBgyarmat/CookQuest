<?php
require __DIR__ . "/../../kapcsolat.php";

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

$receptID = $data["id"];

$sql = "UPDATE recept SET Torolve = 1 WHERE ReceptID = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $receptID);

if (!$stmt->execute()) {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
    exit;
}

echo json_encode([
    "success" => true,
    "affected_rows" => $stmt->affected_rows,
    "id" => $receptID
]);
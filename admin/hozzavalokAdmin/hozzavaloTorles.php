<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["success" => false, "message" => "Nem DELETE kérés"]);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Hiányzó ID"]);
    exit;
}

$hozzavaloID = intval($_GET['id']);

if ($hozzavaloID <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Hibás ID"
    ]);
    exit;
}

$sql = "UPDATE hozzavalo SET Torolve = 1 WHERE HozzavaloID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hozzavaloID);
$stmt->execute();

echo json_encode([
    "success" => true,
    "id" => $hozzavaloID
]);

<?php
require __DIR__ . "/../../kapcsolat.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(["success" => false]);
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["success" => false, "message" => "Hiányzó ID"]);
    exit;
}

$sql = "UPDATE felhasznalo SET Torolve = 1 WHERE FelhasznaloID = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true]);
exit;
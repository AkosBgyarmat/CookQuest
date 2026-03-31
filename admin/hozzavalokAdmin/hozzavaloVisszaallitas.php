<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    echo json_encode(["success" => false, "message" => "Nem PATCH kérés"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Hiányzó ID"]);
    exit;
}

$id = intval($data['id']);

$sql = "UPDATE hozzavalo SET Torolve = 0 WHERE HozzavaloID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode([
    "success" => true,
    "id" => $id
]);
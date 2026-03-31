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

$id = intval($_GET['id']);

$sql = "UPDATE konyhaiFelszereles SET Torolve = 1 WHERE KonyhaiFelszerelesID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode([
    "success" => true,
    "id" => $id
]);
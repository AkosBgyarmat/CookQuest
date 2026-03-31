<?php
require __DIR__ . "/../../kapcsolat.php";

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["success" => false, "message" => "Nem megfelelő metódus"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Hiányzó ID"]);
    exit;
}

$id = intval($data['id']);

$query = "UPDATE recept SET Torolve = 1 WHERE ReceptID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true, "message" => "Törölve"]);
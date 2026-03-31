<?php
require __DIR__ . "/../../kapcsolat.php";

$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Nincs ID"]);
    exit;
}

$id = intval($data['id']);

$query = "UPDATE recept SET Torolve = 0 WHERE ReceptID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true, "method" => $method]);
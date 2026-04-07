<?php
require __DIR__ . "/../../kapcsolat.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$id = $data["id"] ?? null;

$sql = "UPDATE orszag SET Torolve = 0 WHERE OrszagID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true]);
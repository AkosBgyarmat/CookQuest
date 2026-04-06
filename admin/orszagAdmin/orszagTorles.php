<?php
require __DIR__ . "/../../kapcsolat.php";
header("Content-Type: application/json");

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["success" => false]);
    exit;
}

$sql = "UPDATE orszag SET Torolve = 1 WHERE OrszagID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true]);
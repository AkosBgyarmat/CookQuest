<?php
require __DIR__ . "/../../kapcsolat.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["Id"] ?? null;
$nev = $data["Nev"] ?? "";

if (!$id || !$nev) {
    echo json_encode(["success" => false]);
    exit;
}

$sql = "UPDATE orszag SET Elnevezes = ? WHERE OrszagID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nev, $id);
$stmt->execute();

echo json_encode(["success" => true]);
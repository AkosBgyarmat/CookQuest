<?php
require __DIR__ . "/../../kapcsolat.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$nev = $data["Nev"] ?? "";

if (!$nev) {
    echo json_encode(["success" => false]);
    exit;
}

$sql = "INSERT INTO orszag (Elnevezes) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nev);
$stmt->execute();

echo json_encode([
    "success" => true,
    "id" => $conn->insert_id
]);
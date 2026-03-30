<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../kapcsolat.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Nincs adat"]);
    exit;
}

$nev = trim($data["Elnevezes"] ?? "");

if ($nev === "") {
    echo json_encode(["success" => false, "message" => "Adj meg nevet"]);
    exit;
}

// DUPLIKÁCIÓ CHECK
$stmt = $conn->prepare("SELECT HozzavaloID FROM hozzavalo WHERE Elnevezes = ?");
$stmt->bind_param("s", $nev);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Már létezik"]);
    exit;
}

// INSERT
$stmt = $conn->prepare("INSERT INTO hozzavalo (Elnevezes) VALUES (?)");
$stmt->bind_param("s", $nev);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "id" => $conn->insert_id
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "DB hiba"
    ]);
}
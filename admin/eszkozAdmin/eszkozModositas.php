<?php
header("Content-Type: application/json");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../kapcsolat.php";

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    echo json_encode([
        "success" => false,
        "message" => "Nem PATCH kérés"
    ]);
    exit;
}

// adat beolvasás
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs adat"
    ]);
    exit;
}

$id = intval($data["id"] ?? 0);
$nev = trim($data["Nev"] ?? "");
$kep = trim($data["Kep"] ?? "");
$leiras = trim($data["Leiras"] ?? "");
$besorolas = intval($data["BesorolasID"] ?? 0);

// VALIDÁLÁS
if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "Hibás ID"]);
    exit;
}

if ($nev === "") {
    echo json_encode(["success" => false, "message" => "Név kötelező"]);
    exit;
}

// UPDATE
$stmt = $conn->prepare("
    UPDATE konyhaiFelszereles 
    SET Nev = ?, Kep = ?, Leiras = ?, BesorolasID = ? 
    WHERE KonyhaiFelszerelesID = ?
");

if (!$stmt) {
    echo json_encode(["success" => false, "message" => $conn->error]);
    exit;
}

$stmt->bind_param("sssii", $nev, $kep, $leiras, $besorolas, $id);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Sikeres módosítás"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}
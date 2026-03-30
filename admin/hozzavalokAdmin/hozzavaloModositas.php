<?php
header("Content-Type: application/json");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . ("/../../kapcsolat.php");

// JSON beolvasás
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs adat"
    ]);
    exit;
}

$id = isset($data["id"]) ? intval($data["id"]) : 0;
$nev = isset($data["Elnevezes"]) ? trim($data["Elnevezes"]) : "";

// VALIDÁLÁS
if ($id <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Hibás azonosító"
    ]);
    exit;
}

if ($nev === "") {
    echo json_encode([
        "success" => false,
        "message" => "A név megadása kötelező"
    ]);
    exit;
}

// DUPLIKÁCIÓ ELLENŐRZÉS (nem kötelező, de erősen ajánlott)
$stmt = $conn->prepare("SELECT HozzavaloID FROM hozzavalo WHERE Elnevezes = ? AND HozzavaloID != ?");
$stmt->bind_param("si", $nev, $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Ez a hozzávaló már létezik"
    ]);
    exit;
}

// UPDATE
$stmt = $conn->prepare("UPDATE hozzavalo SET Elnevezes = ? WHERE HozzavaloID = ?");
$stmt->bind_param("si", $nev, $id);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Sikeres módosítás"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Adatbázis hiba"
    ]);
}
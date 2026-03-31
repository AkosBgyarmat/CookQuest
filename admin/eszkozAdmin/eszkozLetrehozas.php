<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

// JSON beolvasás
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs adat"
    ]);
    exit;
}

// adatok
$nev = trim($data["Nev"] ?? "");
$kep = trim($data["Kep"] ?? "");
$leiras = trim($data["Leiras"] ?? "");
$besorolas = intval($data["BesorolasID"] ?? 0);

// VALIDÁLÁS
if ($nev === "") {
    echo json_encode([
        "success" => false,
        "message" => "Név kötelező"
    ]);
    exit;
}

if ($besorolas <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Besorolás kötelező"
    ]);
    exit;
}

// DUPLIKÁCIÓ (opcionális, de menő)
$stmt = $conn->prepare("SELECT KonyhaiFelszerelesID FROM konyhaifelszereles WHERE Nev = ?");
$stmt->bind_param("s", $nev);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "Ez az eszköz már létezik"
    ]);
    exit;
}

// INSERT
$stmt = $conn->prepare("
    INSERT INTO konyhaifelszereles 
    (Nev, Kep, Leiras, BesorolasID, Torolve) 
    VALUES (?, ?, ?, ?, 0)
");

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("sssi", $nev, $kep, $leiras, $besorolas);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "id" => $stmt->insert_id,
        "message" => "Sikeres létrehozás"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}
<?php
require __DIR__ . "/../../kapcsolat.php"; //kapcsolódás az adatbázishoz

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// DEBUG
if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs adat",
        "raw" => $raw
    ]);
    exit;
}

$receptID = $data["id"];

// RECEPT UPDATE
$sql = "UPDATE recept SET
    Nev = ?,
    Kep = ?,
    ElkeszitesiIdo = ?,
    NehezsegiSzintID = ?,
    BegyujthetoPontok = ?,
    Adag = ?,
    Elkeszitesi_leiras = ?,
    ElkeszitesiModID = ?,
    ArkategoriaID = ?,
    AlkategoriaID = ?,
    Kaloria = ?
WHERE ReceptID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssiiisiiidi",
    $data["Nev"],
    $data["Kep"],
    $data["ElkeszitesiIdo"],
    $data["NehezsegiSzintID"],
    $data["BegyujthetoPontok"],
    $data["Adag"],
    $data["Elkeszitesi_leiras"],
    $data["ElkeszitesiModID"],
    $data["ArkategoriaID"],
    $data["AlkategoriaID"],
    $data["Kaloria"],
    $receptID
);
$stmt->execute();

// HOZZÁVALÓK TÖRLÉS
$del = $conn->prepare("DELETE FROM recept_hozzavalo WHERE ReceptID = ?");
$del->bind_param("i", $receptID);
$del->execute();

// ÚJ HOZZÁVALÓK
foreach ($data["hozzavalok"] as $h) {

    if (!$h["HozzavaloID"]) continue;

    $stmt = $conn->prepare("
        INSERT INTO recept_hozzavalo 
        (ReceptID, HozzavaloID, Mennyiseg, MertekegysegID)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "iidi",
        $receptID,
        $h["HozzavaloID"],
        $h["Mennyiseg"],
        $h["MertekegysegID"]
    );

    $stmt->execute();
}

echo json_encode(["success" => true]);
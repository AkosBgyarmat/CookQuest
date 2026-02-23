<?php
session_start();
header("Content-Type: application/json");

require_once("../kapcsolat.php");

if (!isset($_SESSION["felhasznalo_id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs bejelentkezve."
    ]);
    exit;
}

$felhasznaloID = $_SESSION["felhasznalo_id"];

$stmt = $conn->prepare("
    SELECT 
        f.Vezeteknev,
        f.Keresztnev,
        f.Felhasznalonev,
        f.Emailcim,
        f.SzuletesiEv,
        f.Profilkep,
        f.RegisztracioEve,
        f.MegszerzettPontok,
        f.OrszagID,
        o.Elnevezes AS OrszagNev
    FROM felhasznalo f
    JOIN orszag o ON f.OrszagID = o.OrszagId
    WHERE f.FelhasznaloID = ?
");

$stmt->bind_param("i", $felhasznaloID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Felhasználó nem található."
    ]);
    exit;
}

$user = $result->fetch_assoc();

echo json_encode([
    "success" => true,
    "user" => $user
]);
<?php
session_start();
header("Content-Type: application/json");

require_once("../kapcsolat.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION["felhasznalo_id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs bejelentkezve."
    ]);
    exit;
}

if (empty($data["ujFelhasznalonev"])) {
    echo json_encode([
        "success" => false,
        "message" => "Új felhasználónév megadása kötelező."
    ]);
    exit;
}

$felhasznaloID = $_SESSION["felhasznalo_id"];
$ujFelhasznalonev = trim($data["ujFelhasznalonev"]);

try {

    // Ellenőrizzük hogy létezik-e már
    $check = $conn->prepare("SELECT FelhasznaloID FROM felhasznalo WHERE Felhasznalonev = ?");
    $check->bind_param("s", $ujFelhasznalonev);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode([
            "success" => false,
            "message" => "Ez a felhasználónév már foglalt."
        ]);
        exit;
    }

    // Frissítés
    $stmt = $conn->prepare("UPDATE felhasznalo SET Felhasznalonev = ? WHERE FelhasznaloID = ?");
    $stmt->bind_param("si", $ujFelhasznalonev, $felhasznaloID);
    $stmt->execute();

    $_SESSION["felhasznalo_nev"] = $ujFelhasznalonev;

    echo json_encode([
        "success" => true
    ]);

} catch (mysqli_sql_exception $e) {

    echo json_encode([
        "success" => false,
        "message" => "Adatbázis hiba."
    ]);
}
<?php
session_start();
header("Content-Type: application/json");

require_once("../kapcsolat.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Nincs adat"]);
    exit;
}

$vezeteknev = trim($data["Vezeteknev"]);
$keresztnev = trim($data["Keresztnev"]);
$felhasznalonev = trim($data["Felhasznalonev"]);
$email = trim($data["Emailcim"]);
$jelszo = $data["Jelszo"];
$szuletesiEv = $data["SzuletesiEv"];
$orszagID = $data["OrszagID"];

$hash = password_hash($jelszo, PASSWORD_DEFAULT);

try {

    $stmt = $conn->prepare("
        INSERT INTO felhasznalo 
        (Vezeteknev, Keresztnev, Felhasznalonev, Emailcim, Jelszo, 
         SzuletesiEv, OrszagID, RegisztracioEve, MegszerzettPontok, SzerepID)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $regEv = date("Y"); // Regisztráció éve
    $pontok = 0; // Kezdeti pontok
    $szerepID = 2; // Alapértelmezett szerep: felhasználó

    $stmt->bind_param(
        "sssssisiii",
        $vezeteknev,
        $keresztnev,
        $felhasznalonev,
        $email,
        $hash,
        $szuletesiEv,
        $orszagID,
        $regEv,
        $pontok,
        $szerepID
    );

    $stmt->execute();

    $_SESSION["felhasznalo_id"] = $stmt->insert_id;

    echo json_encode(["success" => true]);
}
catch (mysqli_sql_exception $e) {

    echo json_encode([
        "success" => false,
        "message" => "Email vagy felhasználónév már létezik."
    ]);
}



?>
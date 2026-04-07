<?php
require __DIR__ . "/../../kapcsolat.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Hiányzó adatok"]);
    exit;
}

$vezeteknev = $data["Vezeteknev"] ?? "";
$keresztnev = $data["Keresztnev"] ?? "";
$felhasznalonev = $data["Felhasznalonev"] ?? "";
$email = $data["Emailcim"] ?? "";
$szuletesiEv = $data["SzuletesiEv"] ?? null;
$orszag = $data["OrszagID"] ?? null;
$szerep = $data["SzerepID"] ?? null;
$regEv = $data["RegisztracioEve"] ?? date("Y");
$pontok = $data["MegszerzettPontok"] ?? 0;
$torolve = 0;

// 🔥 JELSZÓ KÖTELEZŐ CREATE-NÉL
if (empty($data["Jelszo"])) {
    echo json_encode([
        "success" => false,
        "message" => "Jelszó kötelező!"
    ]);
    exit;
}

$jelszo = password_hash($data["Jelszo"], PASSWORD_DEFAULT);

$sql = "INSERT INTO felhasznalo (
    Vezeteknev,
    Keresztnev,
    Felhasznalonev,
    Emailcim,
    Jelszo,
    SzuletesiEv,
    OrszagID,
    RegisztracioEve,
    MegszerzettPontok,
    SzerepID,
    Torolve
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "SQL hiba"]);
    exit;
}

$stmt->bind_param(
    "sssssiisiii",
    $vezeteknev,
    $keresztnev,
    $felhasznalonev,
    $email,
    $jelszo,
    $szuletesiEv,
    $orszag,
    $regEv,
    $pontok,
    $szerep,
    $torolve
);

if (!$stmt->execute()) {
    echo json_encode([
        "success" => false,
        "message" => "Insert hiba"
    ]);
    exit;
}

$newId = $conn->insert_id;

echo json_encode([
    "success" => true,
    "id" => $newId
]);
exit;
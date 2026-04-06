<?php
require __DIR__ . "/../../kapcsolat.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

// 🔥 PATCH adat beolvasása
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data["id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Hiányzó adatok"
    ]);
    exit;
}

$id = $data["id"];
$vezeteknev = $data["Vezeteknev"] ?? "";
$keresztnev = $data["Keresztnev"] ?? "";
$felhasznalonev = $data["Felhasznalonev"] ?? "";
$email = $data["Emailcim"] ?? "";
$szuletesiEv = $data["SzuletesiEv"] ?? null;
$orszag = $data["OrszagID"] ?? "";
$szerep = $data["SzerepID"] ?? "";
$pontok = $data["MegszerzettPontok"] ?? 0;

// 🔥 JELSZÓ KEZELÉS (CSAK HA VAN)
$jelszoSql = "";
$params = [
    $vezeteknev,
    $keresztnev,
    $felhasznalonev,
    $email,
    $szuletesiEv,
    $orszag,
    $szerep,
    $pontok
];

if (!empty($data["Jelszo"])) {
    $hash = password_hash($data["Jelszo"], PASSWORD_DEFAULT);
    $jelszoSql = ", Jelszo = ?";
    $params[] = $hash;
}

$sql = "UPDATE felhasznalo SET
    Vezeteknev = ?,
    Keresztnev = ?,
    Felhasznalonev = ?,
    Emailcim = ?,
    SzuletesiEv = ?,
    OrszagID = ?,     
    SzerepID = ?,     
    MegszerzettPontok = ?
    $jelszoSql
    WHERE FelhasznaloID = ?";

// id mindig utolsó
$params[] = $id;

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "SQL hiba"
    ]);
    exit;
}

$stmt->execute($params);

echo json_encode([
    "success" => true
]);
exit();
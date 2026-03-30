<?php
require __DIR__ . "/../../kapcsolat.php";

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    echo json_encode([
        'success' => false,
        'message' => 'Nincs adat a kérésben.',
        'raw' => $raw
    ]);
    exit;
}

$kep = isset($data['Kep']) ? trim($data['Kep']) : '';
$nev = isset($data['Nev']) ? trim($data['Nev']) : '';
$elkeszitesiIdo = isset($data['ElkeszitesiIdo']) ? $data['ElkeszitesiIdo'] : '';
$nehezseg = isset($data['NehezsegiSzintID']) ? intval($data['NehezsegiSzintID']) : 0;
$begyujthetoPontok = isset($data['BegyujthetoPontok']) ? intval($data['BegyujthetoPontok']) : 0;
$adag = isset($data['Adag']) ? intval($data['Adag']) : 0;
$elkeszitesiLeiras = isset($data['Elkeszitesi_leiras']) ? trim($data['Elkeszitesi_leiras']) : '';
$elkeszitesiModID = isset($data['ElkeszitesiModID']) ? intval($data['ElkeszitesiModID']) : 0;
$arkategoriaID = isset($data['ArkategoriaID']) ? intval($data['ArkategoriaID']) : 0;
$alkategoriaID = isset($data['AlkategoriaID']) ? intval($data['AlkategoriaID']) : 0;
$kaloria = isset($data['Kaloria']) ? floatval($data['Kaloria']) : 0;

$sql = "INSERT INTO recept (
    Nev,
    Kep,
    ElkeszitesiIdo,
    NehezsegiSzintID,
    BegyujthetoPontok,
    Adag,
    Elkeszitesi_leiras,
    ElkeszitesiModID,
    ArkategoriaID,
    AlkategoriaID,
    Kaloria
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Nem sikerült előkészíteni a lekérdezést: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param(
    'sssiiisiiid',
    $nev,
    $kep,
    $elkeszitesiIdo,
    $nehezseg,
    $begyujthetoPontok,
    $adag,
    $elkeszitesiLeiras,
    $elkeszitesiModID,
    $arkategoriaID,
    $alkategoriaID,
    $kaloria
);

if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'A recept mentése sikertelen: ' . $stmt->error
    ]);
    exit;
}

$receptID = $stmt->insert_id;
$stmt->close();

if (!empty($data['hozzavalok']) && is_array($data['hozzavalok'])) {
    $stmt = $conn->prepare("INSERT INTO recept_hozzavalo (ReceptID, HozzavaloID, Mennyiseg, MertekegysegID) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        foreach ($data['hozzavalok'] as $h) {
            if (empty($h['HozzavaloID'])) {
                continue;
            }

            $mennyiseg = isset($h['Mennyiseg']) ? floatval($h['Mennyiseg']) : 0;
            $stmt->bind_param(
                'iidi',
                $receptID,
                $h['HozzavaloID'],
                $mennyiseg,
                $h['MertekegysegID']
            );
            $stmt->execute();
        }
        $stmt->close();
    }
}

echo json_encode([
    'success' => true,
    'id' => $receptID
]);

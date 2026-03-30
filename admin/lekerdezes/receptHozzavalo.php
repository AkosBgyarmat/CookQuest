<?php
require __DIR__ . "/../../kapcsolat.php";

$receptID = $_GET["receptID"] ?? 0;

$sql = "
SELECT 
    rh.HozzavaloID,
    h.Elnevezes AS Nev,
    rh.Mennyiseg,

    rh.MertekegysegID,
    me.Elnevezes AS Mertekegyseg

FROM recept_hozzavalo rh
JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID
JOIN mertekegyseg me ON rh.MertekegysegID = me.MertekegysegID

WHERE rh.ReceptID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $receptID);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
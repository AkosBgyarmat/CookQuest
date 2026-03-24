<?php
require_once __DIR__ . "/../../kapcsolat.php";


$eszkoz = $conn->query("SELECT COUNT(*) as db FROM konyhaifelszereles")->fetch_assoc();
$recept = $conn->query("SELECT COUNT(*) as db FROM recept")->fetch_assoc();
$felhasznalo = $conn->query("SELECT COUNT(*) as db FROM felhasznalo")->fetch_assoc();

$eszkozok = $eszkoz['db'];
$receptek = $recept['db'];
$felhasznalok = $felhasznalo['db'];

$sql = "
SELECT 
    o.Elnevezes, 
    COUNT(f.FelhasznaloID) as db
FROM orszag o
LEFT JOIN felhasznalo f 
    ON o.OrszagID = f.OrszagID
GROUP BY o.OrszagID, o.Elnevezes
ORDER BY db DESC
LIMIT 5
";

$result = $conn->query($sql);

$labels = [];
$adatok = [];


while($row = $result->fetch_assoc()) {
    $labels[] = $row['Elnevezes'];
    $adatok[] = (int)$row['db'];
}
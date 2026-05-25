<?php

require __DIR__ . "/../../kapcsolat.php";

//SQL lekérdezés az adatbázis táblából a rekordok betöltése
$sql = "
SELECT 
    f.FelhasznaloID AS id,
    f.Vezeteknev,
    f.Keresztnev,
    f.Felhasznalonev,
    f.Emailcim,
    f.SzuletesiEv,
    f.Profilkep,
    o.Elnevezes AS Orszag,
    f.RegisztracioEve,
    f.MegszerzettPontok,
    sz.Szerep,
    f.Torolve
FROM felhasznalo f
JOIN orszag o ON f.OrszagID = o.OrszagID
JOIN szerep sz ON f.SzerepID = sz.SzerepID
ORDER BY f.FelhasznaloID ASC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die(json_encode([
        "success" => false,
        "error" => mysqli_error($conn)
    ]));
}

$data = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>
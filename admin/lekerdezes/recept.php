<?php

require __DIR__ . "/../../kapcsolat.php"; //kapcsolódás az adatbázishoz

//SQL lekérdezés az adatbázis táblából a rekordok betöltése
$sql = "
SELECT 
    r.ReceptID AS id,
    r.Nev,
    r.Kep,
    r.ElkeszitesiIdo,

    r.NehezsegiSzintID,
    ns.Szint AS Nehezseg,

    r.BegyujthetoPontok,
    r.Adag,
    r.Elkeszitesi_leiras,

    r.ElkeszitesiModID,
    em.ElkeszitesiMod AS ElkeszitesiMod,

    r.ArkategoriaID,              
    ark.Arkategoria AS Arkategoria,

    r.AlkategoriaID,
    ak.Alkategoria AS Alkategoria,

    r.Kaloria,
    r.Torolve

FROM recept r
JOIN nehezsegiszint ns ON r.NehezsegiSzintID = ns.NehezsegiSzintID
JOIN alkategoria ak ON r.AlkategoriaID = ak.AlkategoriaID
JOIN elkeszitesimod em ON r.ElkeszitesiModID = em.ElkeszitesiModID
JOIN arkategoria ark ON r.ArkategoriaID = ark.ArkategoriaID
ORDER BY r.ReceptID ASC;
";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

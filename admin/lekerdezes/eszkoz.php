<?php

require "../../kapcsolat.php"; //kapcsolódás az adatbázishoz

//SQL lekérdezés az adatbázis táblából a rekordok betöltése
$sql = "
SELECT 
    e.KonyhaiFelszerelesID AS id,
    e.Nev,
    e.Kep,
    e.Leiras,
    b.Elnevezes AS Besorolas_nev
FROM konyhaifelszereles e
JOIN besorolas b ON e.BesorolasID = b.BesorolasID
ORDER BY e.KonyhaiFelszerelesID ASC
";

$result = mysqli_query($conn, $sql);

$data = [];

$row = mysqli_num_rows($result) > 0;

if ($result && $row > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

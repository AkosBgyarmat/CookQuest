<?php
header('Content-Type:application/json; charset-utf-8'); //a válasz típusa JSON lesz és a karakter kódolás utf-8

/** 
 * require: nem engedi hiba esetén betölteni az oldalt
 * include: engedi betölteni az oldalt
 */

require "../kapcsolat.php"; //kapcsolódás az adatbázishoz

//SQL lekérdezés az adatbázis táblából a rekordok betöltése
$sql = "
    SELECT 
    e.KonyhaiFelszerelesID,
    e.Nev,
    e.Kep,
    e.Leiras,
    b.Elnevezes AS Besorolas_nev
FROM konyhaifelszereles e
JOIN besorolas b ON e.BesorolasID = b.BesorolasID
";

//Végrehajtjuk a lekérdezést
$result = mysqli_query($conn, $sql);
//var_dump($result);

//Létrehozunk egy tömböt az adatok tárolására
$data = [];

$row = mysqli_num_rows($result) > 0;
//var_dump($row);

//ha van eredmény és legalább 1 sor van akkor olvasuk be soronként
if ($result && $row > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        //var_dump($data);
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

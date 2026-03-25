<?php

require __DIR__ . '/kapcsolat.php';

$q = $_GET['q'] ?? '';
$eredmenyek = [];

echo "Keresett szöveg: " . htmlspecialchars($q);

$keresett = "%" . $q . "%";

$sql1 = "SELECT ReceptID, Nev FROM recept WHERE Nev LIKE ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $keresett);
$stmt1->execute();
$result1 = $stmt1->get_result();

while ($row = $result1->fetch_assoc()) {
    $eredmenyek[] = [
        "id" => $row["ReceptID"],
        "nev" => $row["Nev"],
        "tipus" => "recept"
    ];
}

$sql2 = "SELECT KonyhaiFelszerelesID, Nev FROM konyhaifelszereles WHERE Nev LIKE ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $keresett);
$stmt2->execute();
$result2 = $stmt2->get_result();

while ($row = $result2->fetch_assoc()) {
    $eredmenyek[] = [
        "id" => $row["KonyhaiFelszerelesID"],
        "nev" => $row["Nev"],
        "tipus" => "felszereles"
    ];
}

echo "<ul>";

foreach ($eredmenyek as $item) {

    echo "<li>";

    if ($item["tipus"] == "recept") {
        echo "<a href='views/receptek/receptek.php?id=" . $item["id"] . "&q=" . urlencode($q) . "'>";        echo "[Recept] ";
    }

    if ($item["tipus"] == "felszereles") {
        echo "<a href='views/konyhaiEszkozok/konyhaiEszkozok.php?id=" . $item["id"] . "&q=" . urlencode($q) . "'>";
        echo "[Eszköz] ";
    }

    echo htmlspecialchars($item["nev"]);
    echo "</a>";

    echo "</li>";
}

echo "</ul>";
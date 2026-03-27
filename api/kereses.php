<?php

require __DIR__ . '/../kapcsolat.php';

header("Content-Type: application/json");

$q = $_GET['q'] ?? '';
$eredmenyek = [];

$keresett = "%" . $q . "%";

// RECEPTEK
$sql1 = "SELECT ReceptID, Nev, Kep FROM recept WHERE Nev LIKE ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $keresett);
$stmt1->execute();
$result1 = $stmt1->get_result();

while ($row = $result1->fetch_assoc()) {
    $eredmenyek[] = [
        "id" => $row["ReceptID"],
        "nev" => $row["Nev"],
        "kep" => $row["Kep"],
        "tipus" => "recept"
    ];
}

// ESZKÖZÖK
$sql2 = "SELECT KonyhaiFelszerelesID, Nev, Kep FROM konyhaifelszereles WHERE Nev LIKE ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $keresett);
$stmt2->execute();
$result2 = $stmt2->get_result();

while ($row = $result2->fetch_assoc()) {
    $eredmenyek[] = [
        "id" => $row["KonyhaiFelszerelesID"],
        "nev" => $row["Nev"],
        "kep" => $row["Kep"],
        "tipus" => "felszereles"
    ];
}

echo json_encode($eredmenyek);
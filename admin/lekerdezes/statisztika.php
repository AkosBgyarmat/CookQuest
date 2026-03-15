<?php
require_once "../kapcsolat.php";


$eszkoz = $conn->query("SELECT COUNT(*) as db FROM konyhaifelszereles")->fetch_assoc();
$recept = $conn->query("SELECT COUNT(*) as db FROM recept")->fetch_assoc();
$felhasznalo = $conn->query("SELECT COUNT(*) as db FROM felhasznalo")->fetch_assoc();

$eszkozok = $eszkoz['db'];
$receptek = $recept['db'];
$felhasznalok = $felhasznalo['db'];
<?php
// PDO kapcsolat létrehozása / visszaadása.
function pdoKapcsolat(): PDO
{
    // Egyetlen kapcsolatpéldány újrahasznosítása.
    static $pdo = null;

    if ($pdo instanceof PDO) return $pdo;

    $pdo = new PDO(
        "mysql:host=localhost;dbname=cookquest;charset=utf8mb4",
        "root",
        "",
        [
            // Hiba esetén kivétel.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Alapértelmezett lekérdezés-formátum.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    return $pdo;
}
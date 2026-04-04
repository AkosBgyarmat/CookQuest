<?php
require_once __DIR__ . ("/../../kapcsolat.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'PATCH') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];
    $nev = $data['Kategoria'];

    $sql = "UPDATE kategoria
            SET Kategoria = ?
            WHERE KategoriaID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nev, $id);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Hiba történt az adatbázisban."
        ]);
    }
}
?>
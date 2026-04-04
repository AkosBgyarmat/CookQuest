<?php
require_once __DIR__ . ("/../../kapcsolat.php");

$method = $_SERVER['REQUEST_METHOD'];



if ($method === 'PATCH') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];
    $nev = $data['Elnevezes'];

    $sql = "UPDATE Besorolas 
            SET Elnevezes = ? 
            WHERE BesorolasID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nev, $id);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Sikeres módosítás"
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Hiba történt"]);
    }
}

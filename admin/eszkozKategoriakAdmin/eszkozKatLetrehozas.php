<?php 
require_once __DIR__ . ("/../../kapcsolat.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    $nev = $data['Elnevezes'];

    $sql = "INSERT INTO besorolas (ELnevezes, Torolve) VALUES (?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nev);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "id" => $conn->insert_id
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}
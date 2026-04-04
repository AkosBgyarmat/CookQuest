<?php

include __DIR__ . ("/../../kapcsolat.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'PATCH') {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data['id'];

    $sql = "UPDATE besorolas SET Torolve = 0 WHERE BesorolasID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true
        ]);
    } else {
        echo json_encode([
            "success" => false
        ]);
    }
}
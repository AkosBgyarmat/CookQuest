<?php
require_once __DIR__ . ("/../../kapcsolat.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'DELETE') {

    $id = $_GET['id'];

    $sql = "UPDATE kategoria SET Torolve = 1 WHERE KategoriaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    echo json_encode([
        "success" => $stmt->execute()
    ]);
}
?>
<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

if (!isset($_GET["id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Hiányzó ID"
    ]);
    exit;
}

$id = intval($_GET["id"]);

if ($id <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Hibás ID"
    ]);
    exit;
}

$stmt = $conn->prepare("
    UPDATE konyhaifelszereles 
    SET Torolve = 0 
    WHERE KonyhaiFelszerelesID = ?
");

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Visszaállítva"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}
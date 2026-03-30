<?php
header("Content-Type: application/json");

require __DIR__ . "/../../kapcsolat.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // biztonság

    $query = "UPDATE hozzavalo SET Torolve = 0 WHERE HozzavaloID = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "success" => true,
            "message" => "Hozzávaló visszaállítva."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Nem történt módosítás vagy hibás ID."
        ]);
    }

} else {
    echo json_encode([
        "success" => false,
        "message" => "Hiányzó ID."
    ]);
}
?>
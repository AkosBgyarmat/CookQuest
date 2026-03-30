<?php
require __DIR__ . "/../../kapcsolat.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Biztonságos típuskonverzió
    $query = "UPDATE recept SET Torolve = 0 WHERE ReceptID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Recept visszaállítva."]);
    } else {
        echo json_encode(["success" => false, "message" => "Hiba történt a visszaállítás során."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Hiányzó ID."]);
}
?>
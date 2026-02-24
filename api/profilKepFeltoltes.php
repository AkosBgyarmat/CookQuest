<?php
session_start();
header("Content-Type: application/json");

error_reporting(0);
ini_set('display_errors', 0);

require_once("../kapcsolat.php");

if (!isset($_SESSION["felhasznalo_id"])) {
    echo json_encode(["success" => false, "message" => "Nincs bejelentkezve."]);
    exit;
}

if (!isset($_FILES["profileImage"])) {
    echo json_encode(["success" => false, "message" => "Nincs fájl feltöltve."]);
    exit;
}

$felhasznaloID = $_SESSION["felhasznalo_id"];

$uploadDir = "../assets/kepek/profilKepek/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$file = $_FILES["profileImage"];

if ($file["size"] > 2 * 1024 * 1024) {
    echo json_encode(["success" => false, "message" => "Max 2MB lehet."]);
    exit;
}

$allowedTypes = ["jpg", "jpeg", "png", "webp"];
$extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

if (!in_array($extension, $allowedTypes)) {
    echo json_encode(["success" => false, "message" => "Csak JPG, PNG, WEBP engedélyezett."]);
    exit;
}

$newFileName = "user_" . $felhasznaloID . "_" . time() . "." . $extension;
$targetPath = $uploadDir . $newFileName;

if (move_uploaded_file($file["tmp_name"], $targetPath)) {

    $relativePath = "assets/kepek/profilKepek/" . $newFileName;

    // Régi kép lekérése
    $oldStmt = $conn->prepare("SELECT ProfilKep FROM felhasznalo WHERE FelhasznaloID = ?");
    $oldStmt->bind_param("i", $felhasznaloID);
    $oldStmt->execute();
    $oldResult = $oldStmt->get_result();
    $oldData = $oldResult->fetch_assoc();

    if (!empty($oldData["ProfilKep"]) && file_exists("../" . $oldData["ProfilKep"])) {
        unlink("../" . $oldData["ProfilKep"]);
    }

    $stmt = $conn->prepare("UPDATE felhasznalo SET ProfilKep = ? WHERE FelhasznaloID = ?");
    $stmt->bind_param("si", $relativePath, $felhasznaloID);
    $stmt->execute();

    echo json_encode(["success" => true, "path" => $relativePath]);

} else {
    echo json_encode(["success" => false, "message" => "Feltöltési hiba."]);
}
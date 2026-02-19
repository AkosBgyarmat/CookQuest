<?php
session_start();
header("Content-Type: application/json");

require_once("../kapcsolat.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "Nincs adat"
    ]);
    exit;
}

$email = trim($data["Emailcim"]);
$jelszo = $data["Jelszo"];

if (empty($email) || empty($jelszo)) {
    echo json_encode([
        "success" => false,
        "message" => "Email és jelszó kötelező."
    ]);
    exit;
}

try {

    $stmt = $conn->prepare("
        SELECT FelhasznaloID, Jelszo 
        FROM felhasznalo 
        WHERE Emailcim = ?
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    // ❌ Ha nincs ilyen email
    if ($result->num_rows === 0) {
        echo json_encode([
            "success" => false,
            "message" => "Hibás email vagy jelszó."
        ]);
        exit;
    }

    $user = $result->fetch_assoc();

    // ❌ Ha rossz a jelszó
    if (!password_verify($jelszo, $user["Jelszo"])) {
        echo json_encode([
            "success" => false,
            "message" => "Hibás email vagy jelszó."
        ]);
        exit;
    }

    // ✅ Sikeres login
    $_SESSION["felhasznalo_id"] = $user["FelhasznaloID"];

    echo json_encode([
        "success" => true
    ]);
} catch (mysqli_sql_exception $e) {

    echo json_encode([
        "success" => false,
        "message" => "Adatbázis hiba."
    ]);
}

?>
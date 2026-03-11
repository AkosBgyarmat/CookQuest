<?php
session_start();
header("Content-Type: application/json");

require_once("../kapcsolat.php");

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Nincs adat"]);
    exit;
}

if (empty($data["aszf"])) {
    echo json_encode([
        "success" => false,
        "message" => "Az ÁSZF elfogadása kötelező."
    ]);
    exit;
}

$vezeteknev = trim($data["Vezeteknev"]);
$keresztnev = trim($data["Keresztnev"]);
$felhasznalonev = trim($data["Felhasznalonev"]);
$email = trim($data["Emailcim"]);
$jelszo = $data["Jelszo"];
$szuletesiEv = $data["SzuletesiEv"];
$orszagID = $data["OrszagID"];

$hash = password_hash($jelszo, PASSWORD_DEFAULT);

try {

    $stmt = $conn->prepare("
        INSERT INTO felhasznalo 
        (Vezeteknev, Keresztnev, Felhasznalonev, Emailcim, Jelszo, 
         SzuletesiEv, OrszagID, RegisztracioEve, MegszerzettPontok, SzerepID)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $regEv = date("Y"); // Regisztráció éve
    $pontok = 0; // Kezdeti pontok
    $szerepID = 2; // Alapértelmezett szerep: felhasználó

    $stmt->bind_param(
        "sssssisiii",
        $vezeteknev,
        $keresztnev,
        $felhasznalonev,
        $email,
        $hash,
        $szuletesiEv,
        $orszagID,
        $regEv,
        $pontok,
        $szerepID
    );

    $stmt->execute();

    $_SESSION["felhasznalo_id"] = $stmt->insert_id;

    try {

        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hancsika.szgya@gmail.com';
        $mail->Password = 'zatz ftlm qell ntxn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail->setFrom('hancsika.szgya@gmail.com', 'CookQuest');
        $mail->addAddress($email, $keresztnev);
    
        $mail->isHTML(true);
        $mail->Subject = 'Udvozlunk a CookQuesten!';
    
        $mail->Body = "
            <h2>Szia $keresztnev! 👋</h2>
            <p>Köszönjük, hogy regisztráltál a CookQuest oldalra.</p>
            <p>Most már elkezdheted gyűjteni a pontokat és felfedezni a recepteket.</p>
            <br>
            <p>Üdv,<br>CookQuest csapat</p>
        ";
    
        $mail->send();
    
    } catch (Exception $e) {
        error_log($e->getMessage());
    }

    echo json_encode(["success" => true]);
}

catch (mysqli_sql_exception $e) {

    echo json_encode([
        "success" => false,
        "message" => "Email vagy felhasználónév már létezik."
    ]);
}

?>
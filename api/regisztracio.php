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

    try {

        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cookquestinfo@gmail.com';
        $mail->Password = 'tqdf nioz tivc wuzm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail->setFrom('cookquestinfo@gmail.com', 'CookQuest');
        $mail->addAddress($email, $keresztnev);
    
        $mail->isHTML(true);
        $mail->Subject = 'Udvozlunk a CookQuesten!';
    
        $mail->Body = 
        '
        <body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;">
        
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5;padding:40px 0;">
        <tr>
        <td align="center">
        
        <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
        
        <tr>
        <td style="background:#90ab8b;padding:25px;text-align:center;color:white;font-size:26px;font-weight:bold;">
        🍳 CookQuest
        </td>
        </tr>
        
        <tr>
        <td style="padding:35px;text-align:center;color:#333;">
        
        <h2 style="margin-top:0;">Szia '.$keresztnev.'! 👋</h2>
        
        <p style="font-size:16px;line-height:1.6;">
        Örülünk, hogy csatlakoztál a <strong>CookQuest</strong> közösségéhez!
        </p>
        
        <p style="font-size:16px;line-height:1.6;">
        Most már elkezdheted felfedezni a recepteket, új technikákat tanulni és
        pontokat gyűjteni a főzés során.
        </p>
        
        <a href="http://localhost/CookQuest/index.php"
        style="display:inline-block;margin-top:20px;padding:14px 28px;background:#90ab8b;color:white;text-decoration:none;border-radius:6px;font-weight:bold;">
        CookQuest megnyitása
        </a>
        
        </td>
        </tr>
        
        <tr>
        <td style="background:#f0f0f0;padding:18px;text-align:center;font-size:12px;color:#777;">
        © '.date("Y").' CookQuest • Minden jog fenntartva
        </td>
        </tr>
        
        </table>
        
        </td>
        </tr>
        </table>
        
        </body>
        </html>
        ';
    
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
<?php
declare(strict_types=1);

require_once __DIR__ . '/receptek_bootstrap.php';
require_once __DIR__ . '/../services/SzintezesService.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Session kulcs: itt legyen robusztus, hogy ne legyen "undefined".
 
 */
$felhasznaloId = (int)($_SESSION['felhasznalo_id']
    ?? $_SESSION['FelhasznaloID']
    ?? ($_SESSION['user']['FelhasznaloID'] ?? 0)
);

if ($felhasznaloId <= 0) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'hiba' => 'Nincs bejelentkezve.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$receptId = (int)($_POST['recept_id'] ?? 0);
if ($receptId <= 0) {
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'hiba' => 'Hibás recept_id.'], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    $szintezes = new SzintezesService($pdo);
    $result = $szintezes->receptTeljesit($felhasznaloId, $receptId);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => true] + $result, JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'hiba' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
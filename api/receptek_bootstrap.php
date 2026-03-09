<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/adatbazis.php';
require_once __DIR__ . '/receptek_konfig.php';
require_once __DIR__ . '/receptek_seged.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$pdo = pdoKapcsolat();
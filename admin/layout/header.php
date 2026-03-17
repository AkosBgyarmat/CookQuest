<?php
session_start();

if (!isset($_SESSION['felhasznalo_id'])) {
    header("Location: /CookQuest/views/autentikacio/autentikacio.php");
    exit;
}

if ($_SESSION["szerepID"] != 1) {
    header("Location: /CookQuest/views/profil/profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CookQuest Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/CookQuest/assets/css/style.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script src="/CookQuest/admin/js/app.js"></script>

    <link rel="shortcut icon" href="/CookQuest/assets/kepek/favicon/favicon-32x32.png">

</head>


<body class="bg-gray-100 min-h-screen flex font-jost" ng-app="CookQuestAdmin">

    <button id="hamburgerBtn"
        onclick="toggleSidebar()"
        class="md:hidden fixed top-6 left-6 z-50 bg-[#5A7863] text-white px-3 py-2 rounded-lg shadow-lg">
        ☰
    </button>

    <?php include "oldalmenu.php"; ?>


    <div class="flex-1 md:ml-64 flex flex-col">
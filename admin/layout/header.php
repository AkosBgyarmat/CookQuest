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
    <title>Admin Panel</title>

    <!-- Jost font: admin oldalakra is -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Kozos CSS, benne a globalis Jost beallitassal -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="/CookQuest/admin/js/app.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/kepek/favicon/favicon-32x32.png" type="image/x-icon">


</head>

<body class="bg-gray-100 min-h-screen flex font-jost" ng-app="CookQuestAdmin">
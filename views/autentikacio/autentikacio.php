<?php include "../head.php"; ?>

<main class="bg-[#95A792] min-h-screen flex flex-col text-[#403F48] flex-1 flex justify-center align-center min-h-[calc(100vh-4rem)] px-4" ng-controller="authController" ng-cloak>
  
  <?php require_once "regisztracioForm.php"; ?>
  <?php require_once "bejelentkezesForm.php"; ?>

</main>

<?php include("../footer.php"); ?>
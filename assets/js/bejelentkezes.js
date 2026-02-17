angular.module("CookQuest").controller("authController", function ($scope) {

  console.log("Az `authController` fut")
  // Nézet állapot
  $scope.mode = "bejelentkezes"; //Az alapértelmezett megjelenítési mód a bejelentkezési állapot lesz.

  // Nézetváltás
  $scope.showBejelentkezes = function () {
    $scope.mode = "bejelentkezes"; //A bejelentkezéshez tartozó részek megjelenítése.
    $scope.loginSubmitted = false; //A bejelentkezés oldalon a benyújtott form nem lesz elküldve.
  };

  $scope.showRegisztracio = function () {
    $scope.mode = "regisztracio"; //A regisztrációhoz tartozó részek megjelenítése.
    $scope.regSubmitted = false; //A regisztráció oldalon a benyújtott form nem lesz elküldve.
  };

  // Submitted flag-ek
  $scope.regSubmitted = false;
  $scope.loginSubmitted = false;



  // REGISZTRÁCIÓ SUBMIT
  $scope.handleRegister = function (form) {

    $scope.regSubmitted = true;
    $scope.emailExistsError = false;

    if (form.$invalid) {
      return;
    }

    // Például tesztként:
    if ($scope.user.email === "test@gmail.com") {
      $scope.emailExistsError = true;
      return;
    }

    console.log("Regisztráció form valid és email nem foglalt");
  };


  // LOGIN SUBMIT
  $scope.handleLogin = function (form) {
    console.log("Bejelentkezés");

    $scope.loginSubmitted = true;

    if (form.$invalid) {
      console.log("Bejelentkezés hiba")
      return;
    }

    console.log("Login form valid");
    // ide jön majd backend
  };

});
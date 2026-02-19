angular.module("CookQuest").controller("authController", function ($scope, $http) {

  //console.log("Az `authController` fut");

  // Alapértelmezett értékek
  $scope.mode = "bejelentkezes"; //Az alapértelmezett megjelenítési mód a bejelentkezési állapot lesz.
  $scope.user = {}; //A user objektum, amely a form adatait fogja tárolni.
  $scope.currentYear = new Date().getFullYear(); // Dinamikus aktuális év a születési év mezőhöz


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
  $scope.regSubmitted = false; // Ez a flag jelzi, hogy a regisztrációs form elküldésre került-e.
  $scope.loginSubmitted = false; // Ez a flag jelzi, hogy a bejelentkezési form elküldésre került-e.

  $scope.passwordChecks = {
    minLength: false,
    hasNumber: false,
    hasUppercase: false
  };

  $scope.$watch("user.password", function (newValue) {

    if (!newValue) {
      $scope.passwordChecks.minLength = false;
      $scope.passwordChecks.hasNumber = false;
      $scope.passwordChecks.hasUppercase = false;
      return;
    }

    $scope.passwordChecks.minLength = newValue.length >= 8; // Minimum 8 karakter hosszúság ellenőrzése
    $scope.passwordChecks.hasNumber = /\d/.test(newValue); // Ez a regex ellenőrzi, hogy van-e számjegy a jelszóban
    $scope.passwordChecks.hasUppercase = /[A-Z]/.test(newValue); // Ez a regex ellenőrzi, hogy van-e nagybetű a jelszóban

  });


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

    var kuldendoAdat = {
      Vezeteknev: $scope.user.surname,
      Keresztnev: $scope.user.firstName,
      Felhasznalonev: $scope.user.username,
      Emailcim: $scope.user.email,
      Jelszo: $scope.user.password,
      SzuletesiEv: $scope.user.birthDate,
      OrszagID: $scope.user.country
    };

    $http.post("/CookQuest/api/regisztracio.php", kuldendoAdat)
      .then(function (response) {
        console.log("Sikeres regisztráció:", response.data);
      })
      .catch(function (error) {
        console.error("Hiba a regisztráció során:", error);
      });


  };


  // LOGIN SUBMIT
  $scope.handleLogin = function (form) {

    $scope.loginSubmitted = true;

    if (form.$invalid) {
      return;
    }

    var kuldendoAdat = {
      Emailcim: $scope.user.email,
      Jelszo: $scope.user.password
    };

    $http.post("/CookQuest/api/bejelentkezes.php", kuldendoAdat)
      .then(function (response) {

        console.log("Login válasz:", response.data);

        if (response.data.success) {
          alert("Sikeres bejelentkezés!");

          // Itt lehetne átirányítás
          // window.location.href = "/CookQuest/views/index/index.php";

        } else {
          alert(response.data.message);
        }

      })
      .catch(function (error) {
        console.error("Login hiba:", error);
      });
  };
});

//Jelszó vizsgálat
angular.module("CookQuest").directive("passwordMatch", function () {
  return {
    require: "ngModel",
    scope: {
      otherModelValue: "=passwordMatch"
    },
    link: function (scope, element, attrs, ngModel) {

      ngModel.$validators.passwordMismatch = function (modelValue) {

        if (!modelValue || !scope.otherModelValue) {
          return true; // Ha üres, ne mismatch hibát adjunk
        }

        return modelValue === scope.otherModelValue;
      };


      scope.$watch("otherModelValue", function () {
        ngModel.$validate();
      });

    }
  };
});

angular.module("CookQuest").directive("passwordStrength", function () {
  return {
    require: "ngModel",
    link: function (scope, element, attrs, ngModel) {

      ngModel.$validators.passwordStrength = function (modelValue) {

        if (!modelValue) {
          return true; // required kezeli az üres mezőt
        }

        var minLength = modelValue.length >= 8;
        var hasNumber = /\d/.test(modelValue);
        var hasUppercase = /[A-Z]/.test(modelValue);

        return minLength && hasNumber && hasUppercase;
      };

    }
  };
});


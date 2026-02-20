angular.module("CookQuest").controller("authController", function ($scope, $http, $timeout) {

  //console.log("Az `authController` fut");

  // ============== Alapértelmezett értékek ==============

  //Az alapértelmezett megjelenítési mód a bejelentkezési állapot lesz.
  $scope.mode = "bejelentkezes";

  //A user objektum, amely a form adatait fogja tárolni.
  $scope.user = {};

  // Dinamikus aktuális év a születési év mezőhöz
  $scope.currentYear = new Date().getFullYear();

  // Ez a flag jelzi, hogy a regisztráció sikeres volt-e vagy sem.
  $scope.registerSuccess = false;

  // Ez a flag jelzi, hogy a regisztrációs üzenet megjelenjen-e vagy sem.
  $scope.registerMessage = false;

  $scope.closeRegisterMessage = function () {
    $scope.registerMessage = false;
  };

  $scope.closeLoginMessage = function () {
    $scope.loginMessage = false;
    $scope.loginSuccess = false;
    $scope.invalidCredentialsError = false;
  };

  $scope.goToLogin = function () {
    $scope.registerMessage = false;
    $scope.showBejelentkezes();
  };
  $scope.loginMessage = false;
  $scope.loginSuccess = false;
  $scope.invalidCredentialsError = false;
  $scope.isRegistering = false;
  $scope.alreadyRegistered = false;

  // ====================================================

  // Nézetváltás - A bejelentkezési és regisztrációs nézetek közötti váltásért felelős függvények. Ezek a függvények módosítják a $scope.mode értékét, amely meghatározza, hogy melyik nézet jelenjen meg a felhasználó számára.
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

  // Jelszó ellenőrzések
  $scope.passwordChecks = {
    minLength: false,
    hasNumber: false,
    hasUppercase: false
  };

  // Jelszó változásának figyelése
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
  $scope.handleRegister = function (form) { // Ez a függvény akkor fut le, amikor a regisztrációs form elküldésre kerül.


    if ($scope.isRegistering || $scope.alreadyRegistered) {
      return;
    }

    $scope.regSubmitted = true;
    $scope.emailExistsError = false;

    // Ha a form érvénytelen, akkor nem küldjük el az adatokat a szervernek.
    if (form.$invalid) {
      return;
    }

    /*A regisztrációs adatok elküldése a szervernek. 
    Itt egy objektumot hozunk létre, amely tartalmazza a regisztrációs adatokat, majd ezt az objektumot küldjük el a szervernek egy POST kérésben.*/
    var kuldendoAdat = {
      Vezeteknev: $scope.user.surname,
      Keresztnev: $scope.user.firstName,
      Felhasznalonev: $scope.user.username,
      Emailcim: $scope.user.email,
      Jelszo: $scope.user.password,
      SzuletesiEv: $scope.user.birthDate,
      OrszagID: $scope.user.country
    };

    /*A szerver válaszát kezeljük. Ha a regisztráció sikeres, akkor a szerver egy sikeres választ ad vissza, amelyet a konzolon megjelenítünk. Ha a regisztráció nem sikeres, akkor a szerver egy hibaüzenetet ad vissza, amelyet szintén a konzolon megjelenítünk.*/
    $scope.isRegistering = true;

    $http.post("/CookQuest/api/regisztracio.php", kuldendoAdat)
      .then(function (response) {
        if (response.data.success) {


          $scope.registerMessage = true; // Ez a flag jelzi, hogy a regisztrációs üzenet megjelenjen.
          $scope.registerSuccess = true; // Ez a flag jelzi, hogy a regisztráció sikeres volt.
          $scope.alreadyRegistered = true; // Ez a flag jelzi, hogy a regisztráció már megtörtént, így megakadályozzuk a többszöri regisztrációt.

          $scope.user = {}; // A regisztrációs form adatait tartalmazó objektumot újra inicializáljuk, így a form mezői kiürülnek.
          form.$setPristine(); // A form állapotát "pristine"-re állítjuk, ami azt jelenti, hogy a form még nem lett megváltoztatva.
          form.$setUntouched(); // A form állapotát "untouched"-ra állítjuk, ami azt jelenti, hogy a form mezői még nem lettek megérintve.

        } else {

          $scope.registerSuccess = false;
          $scope.registerMessage = true;
          $scope.registerErrorText = response.data.message;

        }
      })
      .catch(function (error) {
        $scope.registerSuccess = false;
        $scope.registerMessage = true;
        $scope.registerErrorText =
          (error.data && error.data.message)
            ? error.data.message
            : "Hiba történt a regisztráció során.";
      })
      .finally(function () {
        $scope.isRegistering = false;
      });
    ;
  };

  $scope.handleLogin = function (form) {

    $scope.loginSubmitted = true;
    $scope.invalidCredentialsError = false;

    if (form.$invalid) {
      return;
    }

    var kuldendoAdat = {
      Emailcim: $scope.user.email,
      Jelszo: $scope.user.password
    };

    $http.post("/CookQuest/api/bejelentkezes.php", kuldendoAdat)
      .then(function (response) {

        if (response.data.success) {

          $scope.loginSuccess = true;
          $scope.loginMessage = true;

          // opcionális: 1.5 másodperc után átirányítás
          setTimeout(function () {
            window.location.href = "/CookQuest/views/profil/profil.php";
          }, 1500);

        } else {

          $scope.loginSuccess = false;
          $scope.loginMessage = true;
          $scope.invalidCredentialsError = true;

        }

      })
      .catch(function () {

        $scope.loginSuccess = false;
        $scope.loginMessage = true;

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

//Jelszóerősség vizsgálat
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
angular.module("CookQuest").controller("authController", function ($scope, $http) {

  //console.log("Az `authController` fut");

  // ============== Alapértelmezett értékek ==============

  //Az alapértelmezett megjelenítési mód a bejelentkezési állapot lesz.
  $scope.mode = "bejelentkezes";

  //A user objektum, amely a form adatait fogja tárolni.
  $scope.user = {};

  // Dinamikus aktuális év a születési év mezőhöz
  $scope.currentYear = new Date().getFullYear();

  // Ez a változó fogja tárolni a regisztrációs üzeneteket, például sikeres regisztráció vagy hibaüzenetek.
  $scope.registerMessage = "";

  // Ez a flag jelzi, hogy a regisztráció sikeres volt-e vagy sem.
  $scope.registerSuccess = false;

  $scope.registerMessage = false;

  $scope.closeRegisterMessage = function () {
    $scope.registerMessage = false;
  };

  $scope.goToLogin = function () {
    $scope.registerMessage = false;
    $scope.showBejelentkezes();
  };

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
        response.data.success === true
          ($scope.registerMessage = "Sikeres regisztráció! Most már bejelentkezhetsz.", $scope.registerSuccess = true)
          $scope.alreadyRegistered = true;
        $scope.user = {}; // A form adatait tartalmazó objektum törlése, hogy a form újra üres legyen.
        form.$setPrestine(); // A form állapotának visszaállítása, hogy ne legyen "dirty" vagy "submitted" állapotban.
        form.$setUntouched(); // A form mezőinek állapotának visszaállítása, hogy ne legyen "touched" állapotban.
      })
      .catch(function (error) {
        $scope.registerSuccess = false
        $scope.registerMessage = error.data.message || "Hiba történt a regisztráció során. Kérlek, próbáld újra."; // Ha a szerver egy hibaüzenetet ad vissza, akkor azt jelenítjük meg, különben egy általános hibaüzenetet.
      })
      .finally(function () {
        $scope.isRegistering = false;
      });
    ;
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

    $http.post("/CookQuest/api/bejelentkezes.php", kuldendoAdat) //A bejelentkezési adatokat küldjük a szervernek
      .then(function (response) { //A szerver válaszát kezeljük

        console.log("Login válasz:", response.data); //A szerver válaszának megjelenítése a konzolon

        if (response.data.success) { //Ha a bejelentkezés sikeres, akkor a success mező true lesz
          alert("Sikeres bejelentkezés!"); //Sikeres bejelentkezés esetén egy üzenetet jelenítünk meg

          // Itt lehetne átirányítás
          // window.location.href = "/CookQuest/views/index/index.php";

        } else {
          alert(response.data.message); //Ha a bejelentkezés nem sikeres, akkor a szerver által visszaadott message mezőben található hibaüzenetet jelenítjük meg
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
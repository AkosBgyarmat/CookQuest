angular.module("CookQuest").controller("profilController", function ($scope, $http) {

  $scope.user = {};
  $scope.loading = true;

  $scope.showLogoutModal = false;

  $scope.showUsernameModal = false;
  $scope.usernameMessage = false;
  $scope.usernameSuccess = false;
  $scope.usernameErrorText = "";

  $http.get("/CookQuest/api/profilAdat.php")
    .then(function (response) {

      if (response.data.success) {
        $scope.user = response.data.user;
      } else {
        window.location.href = "/CookQuest/views/autentikacio/autentikacio.php";
      }

    })
    .catch(function () {
      //console.log("Hiba történt a profiladatok lekérése során.");
      window.location.href = "/CookQuest/views/autentikacio/autentikacio.php";
    })
    .finally(function () {
      $scope.loading = false;
    }
    );

  $scope.openLogoutModal = function () {
    $scope.showLogoutModal = true;
  };

  $scope.closeLogoutModal = function () {
    $scope.showLogoutModal = false;
  };

  $scope.confirmLogout = function () {
    $http.post("/CookQuest/api/kijelentkezes.php")
      .then(function () {
        window.location.href = "/CookQuest/index.php";
      });
  };

  $scope.uploadProfileImage = function (files) {

    if (!files || files.length === 0) return;

    var formData = new FormData();
    formData.append("profileImage", files[0]);

    $http.post("/CookQuest/api/profilKepFeltoltes.php", formData, {
      transformRequest: angular.identity,
      headers: { 'Content-Type': undefined }
    })
      .then(function (response) {

        if (response.data.success) {
          $scope.user.ProfilKep = response.data.path;
        } else {
          alert(response.data.message);
        }

      })
      .catch(function () {
        alert("Hiba a feltöltés során.");
      });
  };

  $scope.changeUsername = function () {

    if (!$scope.user.ujFelhasznalonev || !$scope.user.megerositetteUjFelhasznalonev) {
  
      $scope.usernameSuccess = false;
      $scope.usernameErrorText = "Tölts ki minden mezőt.";
      $scope.usernameMessage = true;
      return;
  
    }
  
    if ($scope.user.ujFelhasznalonev !== $scope.user.megerositetteUjFelhasznalonev) {
  
      $scope.usernameSuccess = false;
      $scope.usernameErrorText = "A felhasználónevek nem egyeznek.";
      $scope.usernameMessage = true;
      return;
  
    }
  
    var kuldendoAdat = {
      ujFelhasznalonev: $scope.user.ujFelhasznalonev
    };
  
    $http.post("/CookQuest/api/felhasznalonevValtoztatas.php", kuldendoAdat)
  
    .then(function (response) {
  
      if (response.data.success) {
  
        $scope.usernameSuccess = true;
        $scope.usernameMessage = true;
  
        $scope.user.Felhasznalonev = $scope.user.ujFelhasznalonev;
  
        $scope.user.ujFelhasznalonev = "";
        $scope.user.megerositetteUjFelhasznalonev = "";
  
      } else {
  
        $scope.usernameSuccess = false;
        $scope.usernameErrorText = response.data.message;
        $scope.usernameMessage = true;
  
      }
  
    })
  
    .catch(function () {
  
      $scope.usernameSuccess = false;
      $scope.usernameErrorText = "Szerver hiba.";
      $scope.usernameMessage = true;
  
    });
  
  };

  $scope.closeUsernameMessage = function () {

    $scope.usernameMessage = false;

    if ($scope.usernameSuccess) {
      location.reload();
    }

  };

});
angular.module("CookQuest").controller("profilController", function ($scope, $http) {

  $scope.user = {};
  $scope.loading = true;

  $scope.showLogoutModal = false;

  $scope.openLogoutModal = function () {
    $scope.showLogoutModal = true;
  };

  $scope.closeLogoutModal = function () {
    $scope.showLogoutModal = false;
  };

  $scope.confirmLogout = function () {
    $http.post("/CookQuest/api/kijelentkezes.php")
      .then(function () {
        window.location.href = "/CookQuest/views/index/index.php";
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
    });

});
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

  $scope.confirmLogout = function() {
    $http.post("/CookQuest/api/kijelentkezes.php")
      .then(function() {
        window.location.href = "/CookQuest/views/index/index.php";
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
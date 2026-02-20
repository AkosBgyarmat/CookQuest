angular.module("CookQuest").controller("profilController", function ($scope, $http) {

    $scope.user = {};
    $scope.loading = true;
  
    $http.get("/CookQuest/api/profilAdatok.php")
      .then(function (response) {
  
        if (response.data.success) {
          $scope.user = response.data.user;
        } else {
          window.location.href = "/CookQuest/views/autentikacio/autentikacio.php";
        }
  
      })
      .catch(function () {
        window.location.href = "/CookQuest/views/autentikacio/autentikacio.php";
      })
      .finally(function () {
        $scope.loading = false;
      });
  
  });
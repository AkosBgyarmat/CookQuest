let app = angular.module("CookQuest", []);

app.controller("controller", function ($scope, $http) {

    console.log("Controller fut");

    // 🔑 alapértelmezett nézet
    $scope.mode = "eszkozok";

    // 📦 adatbetöltés
    $http.get("/CookQuest/views/konyhaiEszkozok/eszkozok.php")
        .then(function (response) {
            console.log("ESZKÖZÖK:", response.data);
            $scope.eszkozok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

    // 🔁 nézetváltás
    $scope.showEszkozok = function () {
        $scope.mode = "eszkozok";
    };

    $scope.showAtvalto = function () {
        $scope.mode = "atvalto";
    };

});

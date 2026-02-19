angular.module("CookQuest").controller("orszagCtrl", function ($scope, $http) {

    console.log("Ország controller fut");

    //adatbetöltés
    $http.get("/CookQuest/views/autentikacio/orszag.php")
        .then(function (response) {
            console.log("ORSZÁGOK:", response.data);
            $scope.orszagok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
    });
});
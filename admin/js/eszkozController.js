angular.module("CookQuestAdmin").controller("eszkozController", function ($scope, $http) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/eszkoz.php")
        .then(function (response) {
            console.log("ESZKÖZÖK:", response.data);
            $scope.eszkozok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

});
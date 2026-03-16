angular.module("CookQuestAdmin").controller("felhasznaloController", function ($scope, $http) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/felhasznalo.php")
        .then(function (response) {
            //console.log("RECEPTEK:", response.data);
            $scope.felhasznalo = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

});
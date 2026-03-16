angular.module("CookQuestAdmin").controller("receptController", function ($scope, $http) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/recept.php")
        .then(function (response) {
            //console.log("RECEPTEK:", response.data);
            $scope.recept = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

});
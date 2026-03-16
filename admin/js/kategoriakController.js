angular.module("CookQuestAdmin").controller("kategoriaController", function ($scope, $http) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/eszkozKategoria.php")
        .then(function (response) {
            //console.log("Eszköz kategóriák:", response.data);
            $scope.eszkozKategoria = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        }
    );

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/receptKategoria.php")
        .then(function (response) {
            //console.log("Recept kategóriák:", response.data);
            $scope.receptKategoria = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

});
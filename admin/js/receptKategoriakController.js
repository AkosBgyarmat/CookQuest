angular.module("CookQuestAdmin").controller("receptKategoriaController", function ($scope, $http) {

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
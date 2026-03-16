angular.module("CookQuestAdmin").controller("hozzavaloController", function ($scope, $http) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/hozzavalok.php")
        .then(function (response) {
            //console.log("HOZZÁVALÓK:", response.data);
            $scope.hozzavalo = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

});
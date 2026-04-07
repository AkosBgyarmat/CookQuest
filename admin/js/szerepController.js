angular.module("CookQuestAdmin").controller("szerepController", function ($scope, $http) {

    //console.log("Szerep controller fut");

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/szerepek.php")
        .then(function (response) {
            //console.log("SZEREPEK:", response.data);
            $scope.szerepek = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
    });
});
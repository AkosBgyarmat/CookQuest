angular.module("CookQuestAdmin").controller("orszagController", function ($scope, $http) {

    //console.log("Ország controller fut");

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/orszag.php")
        .then(function (response) {
            //console.log("ORSZÁGOK:", response.data);
            $scope.orszagok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
    });
});
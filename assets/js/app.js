//console.log("Angular fut")

let app = angular.module("CookQuest", []);

app.controller('controller', function($scope, $http) {

    console.log("Controller fut")

    $http.get("/CookQuest/views/konyhaiEszkozok/eszkozok.php")
        .then(function(response) {
            console.log(response.data);
            $scope.eszkozok = response.data;
        })
        .catch(function(error) {
            console.error('Nem sikerült:', error);
        });
});
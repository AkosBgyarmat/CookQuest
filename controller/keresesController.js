angular.module("CookQuest").controller("keresesCtrl", function ($scope, $http) {

    $scope.q = new URLSearchParams(window.location.search).get('q') || '';
    $scope.eredmenyek = [];
    $scope.receptek = [];
    $scope.eszkozok = [];

    $http.get("/CookQuest/api/kereses.php?q=" + encodeURIComponent($scope.q))
    .then(function (res) {

        $scope.eredmenyek = res.data;

        // SZÉTVÁLOGATÁS
        $scope.receptek = $scope.eredmenyek.filter(e => e.tipus === 'recept');
        $scope.eszkozok = $scope.eredmenyek.filter(e => e.tipus === 'felszereles');

    });

});
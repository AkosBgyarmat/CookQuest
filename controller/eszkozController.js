angular.module("CookQuest").controller("eszkozCtrl", function ($scope, $http) {

    console.log("Eszközök controller fut");

    //alapértelmezett nézet
    $scope.mode = "eszkozok";
    $scope.eszkozok = [];
    $scope.q = new URLSearchParams(window.location.search).get('q') || '';
    $scope.selectedId = new URLSearchParams(window.location.search).get('id');

    //adatbetöltés
    $http.get("/CookQuest/views/konyhaiEszkozok/eszkozok.php")
        .then(function (response) {
            console.log("ESZKÖZÖK:", response.data);
            $scope.eszkozok = response.data;

            if ($scope.selectedId) {
                let index = $scope.eszkozok.findIndex(e => e.KonyhaiFelszerelesID == $scope.selectedId);

                if (index !== -1) {
                    $scope.currentPage = Math.floor(index / $scope.itemsPerPage) + 1;
                }
            }

            setTimeout(() => {
                if ($scope.selectedId) {
                    let element = document.getElementById('eszkoz-' + $scope.selectedId);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }, 500);
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

    //nézetváltás
    $scope.showEszkozok = function () {
        $scope.mode = "eszkozok";
    };

    $scope.showAtvalto = function () {
        $scope.mode = "atvalto";
    };

    $scope.currentPage = 1;
    $scope.itemsPerPage = 6;

    $scope.totalPages = function () {
        if (!$scope.eszkozok || $scope.eszkozok.length === 0) {
            return 0;
        }
        return Math.ceil($scope.eszkozok.length / $scope.itemsPerPage);
    };

    $scope.setPage = function (page) {
        if (page >= 1 && page <= $scope.totalPages()) {
            $scope.currentPage = page;
        }
    };

    $scope.getPaginatedData = function () {
        if (!$scope.eszkozok) return [];

        const start = ($scope.currentPage - 1) * $scope.itemsPerPage;
        const end = start + $scope.itemsPerPage;
        return $scope.eszkozok.slice(start, end);
    };

    $scope.getPageRange = function () {

        let total = $scope.totalPages();
        let current = $scope.currentPage;
        let maxVisible = 5;

        let start = Math.max(1, current - Math.floor(maxVisible / 2));
        let end = start + maxVisible - 1;

        if (end > total) {
            end = total;
            start = Math.max(1, end - maxVisible + 1);
        }

        let pages = [];
        for (let i = start; i <= end; i++) {
            pages.push(i);
        }

        return pages;
    };



});
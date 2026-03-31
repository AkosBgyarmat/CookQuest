angular.module("CookQuestAdmin").controller("eszkozKategoriaController", function ($scope, $http, $timeout) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/eszkozKategoria.php")
        .then(function (response) {
            $scope.eszkozKategoria = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        }
    );

    $scope.isModalOpen = false;

    // 🔁 ÚJRATÖLTÉS (EZ HIÁNYZOTT!)
    $scope.reload = function () {
        $http.get("/CookQuest/admin/lekerdezes/eszkozKategoria.php")
            .then(function (response) {
                $scope.eszkozKategoria = response.data;
            });
    };

    // 🔔 FEEDBACK
    $scope.feedback = null;

    $scope.showMessage = function (msg) {
        $scope.feedback = msg;
        $timeout(function () {
            $scope.feedback = null;
        }, 2000);
    };

    $scope.createEszkozKategoria = function () {
        let nev = prompt("Add meg az új kategória nevét:");
        if (!nev) return;

        $http.post("/CookQuest/admin/muvelet/eszkozKategoria_letrehozas.php", {
            Elnevezes: nev
        })
        .then(function () {
            $scope.reload();
            $scope.showMessage("Kategória létrehozva");
        });
    };

    $scope.editEszkozKategoria = function (b) {
        $http.patch("/CookQuest/admin/kategoriakAdmin/eszkozKategoriakAdmin/eszkozKatModositas.php", {
            id: b.id,
            Elnevezes: ujNev
        })
        .then(function () {
            $scope.reload();
            $scope.showMessage("Módosítva");
        });

        $scope.isModalOpen = true;
    };

    // 🗑️ TÖRLÉS
    $scope.torles = function (id) {
        if (!confirm("Biztos törlöd?")) return;

        $http.patch("/CookQuest/admin/muvelet/eszkozKategoria_torles.php", {
            id: id
        })
        .then(function () {
            $scope.reload();
            $scope.showMessage("Törölve");
        });
    };

    // ♻️ VISSZAÁLLÍTÁS
    $scope.visszaallitas = function (id) {
        $http.patch("/CookQuest/admin/muvelet/eszkozKategoria_visszaallitas.php", {
            id: id
        })
        .then(function () {
            $scope.reload();
            $scope.showMessage("Visszaállítva");
        });
    };

});
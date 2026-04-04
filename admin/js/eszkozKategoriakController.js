angular.module("CookQuestAdmin").controller("eszkozKategoriaController", function ($scope, $http) {

    // ===== LOAD =====
    $scope.eszkozKategoria = [];

    $scope.reload = function () {
        $http.get("/CookQuest/admin/lekerdezes/eszkozKategoria.php")
            .then(res => {
                $scope.eszkozKategoria = res.data;
                if (window.location.search.indexOf("openNew=1") !== -1) {
                    $scope.createEszkozKategoria();
                }
            });
    };

    $scope.reload();

    // ===== MODAL =====
    $scope.isModalOpen = false;
    $scope.selectedEszkozKategoria = null;

    $scope.createEszkozKategoria = function () {
        $scope.selectedEszkozKategoria = {
            id: null,
            Elnevezes: ""
        };
        $scope.isModalOpen = true;
    };

    $scope.editEszkozKategoria = function (kategoria) {
        $scope.selectedEszkozKategoria = angular.copy(kategoria);
        $scope.isModalOpen = true;
    };

    $scope.closeFeedbackMessage = function () {
        $scope.isModalOpen = false;
        $scope.feedbackMessage = false;
    };

    // ===== FEEDBACK =====
    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    $scope.showFeedback = function (success, text) {
        $scope.feedbackSuccess = success;
        $scope.feedbackText = text;
        $scope.feedbackMessage = true;
    };

    $scope.saveEszkozKategoria = function () {

        if (!$scope.selectedEszkozKategoria.Elnevezes?.trim()) {
            return $scope.showFeedback(false, "Adj meg egy nevet!");
        }

        let isUpdate = !!$scope.selectedEszkozKategoria.id;

        let request = isUpdate
            ? $http.patch("/CookQuest/admin/eszkozKategoriakAdmin/eszkozKatModositas.php", $scope.selectedEszkozKategoria)
            : $http.post("/CookQuest/admin/eszkozKategoriakAdmin/eszkozKatLetrehozas.php", $scope.selectedEszkozKategoria);

        request.then(res => {

            if (!res.data?.success) {
                return $scope.showFeedback(false, res.data?.message || "Hiba történt");
            }

            if (isUpdate) {
                let i = $scope.eszkozKategoria.findIndex(e => e.id == $scope.selectedEszkozKategoria.id);
                if (i !== -1) Object.assign($scope.eszkozKategoria[i], $scope.selectedEszkozKategoria);
            } else {
                $scope.selectedEszkozKategoria.id = res.data.id;
                $scope.eszkozKategoria.push(angular.copy($scope.selectedEszkozKategoria));
            }

            $scope.closeFeedbackMessage();
            $scope.showFeedback(true, isUpdate ? "Módosítva!" : "Létrehozva!");

        }).catch(() => {
            $scope.showFeedback(false, "Szerver hiba");
        });
    };

    // ===== DELETE =====
    $scope.torles = function (id) {

        $scope.openConfirm("Biztos törlöd?", function () {

            $http.delete("/CookQuest/admin/eszkozKategoriakAdmin/eszkozKatTorles.php?id=" + id)
                .then(() => {
                    let i = $scope.eszkozKategoria.findIndex(e => e.id == id);
                    if (i !== -1) $scope.eszkozKategoria[i].Torolve = 1;
                    $scope.showFeedback(true, "Törölve");
                });

        });
    };

    // ===== RESTORE =====
    $scope.visszaallitas = function (id) {

        $scope.openConfirm("Biztos visszaállítod?", function () {

            $http.patch("/CookQuest/admin/eszkozKategoriakAdmin/eszkozVisszaallitas.php", { id })
                .then(() => {
                    let i = $scope.eszkozKategoria.findIndex(e => e.id == id);
                    if (i !== -1) $scope.eszkozKategoria[i].Torolve = 0;
                    $scope.showFeedback(true, "Visszaállítva");
                });

        });
    };

    // ===== CONFIRM =====
    $scope.confirmModal = false;
    $scope.confirmText = "";
    $scope.confirmAction = null;

    $scope.openConfirm = function (text, action) {
        $scope.confirmText = text;
        $scope.confirmAction = action;
        $scope.confirmModal = true;
    };

    $scope.confirmOk = function () {
        $scope.confirmAction?.();
        $scope.confirmModal = false;
    };

    $scope.confirmCancel = function () {
        $scope.confirmModal = false;
    };

});
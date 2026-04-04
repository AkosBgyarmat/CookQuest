angular.module("CookQuestAdmin").controller("receptKategoriaController", function ($scope, $http) {

    // ===== LOAD =====
    $scope.receptKategoria = [];

    $scope.reload = function () {
        $http.get("/CookQuest/admin/lekerdezes/receptKategoria.php")
            .then(res => {
                $scope.receptKategoria = res.data;
                if (window.location.search.indexOf("openNew=1") !== -1) {
                    $scope.createReceptKategoria();
                }
            });
    };

    $scope.reload();

    // ===== MODAL =====
    $scope.isModalOpen = false;
    $scope.selectedReceptKategoria = null;

    $scope.createReceptKategoria = function () {
        $scope.selectedReceptKategoria = {
            id: null,
            Kategoria: ""
        };
        $scope.isModalOpen = true;
    };

    $scope.editReceptKategoria = function (kategoria) {
        $scope.selectedReceptKategoria = angular.copy(kategoria);
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

    $scope.saveReceptKategoria = function () {

        if (!$scope.selectedReceptKategoria.Kategoria?.trim()) {
            return $scope.showFeedback(false, "Adj meg egy nevet!");
        }

        let isUpdate = !!$scope.selectedReceptKategoria.id;

        let request = isUpdate
            ? $http.patch("/CookQuest/admin/receptKategoriakAdmin/receptKatModositas.php", $scope.selectedReceptKategoria)
            : $http.post("/CookQuest/admin/receptKategoriakAdmin/receptKatLetrehozas.php", $scope.selectedReceptKategoria);

        request.then(res => {

            if (!res.data?.success) {
                return $scope.showFeedback(false, res.data?.message || "Hiba történt");
            }

            if (isUpdate) {
                let i = $scope.receptKategoria.findIndex(e => e.id == $scope.selectedReceptKategoria.id);
                if (i !== -1) Object.assign($scope.receptKategoria[i], $scope.selectedReceptKategoria);
            } else {
                $scope.selectedReceptKategoria.id = res.data.id;
                $scope.receptKategoria.push(angular.copy($scope.selectedReceptKategoria));
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

            $http.delete("/CookQuest/admin/receptKategoriakAdmin/receptKatTorles.php?id=" + id)
                .then(() => {
                    let i = $scope.receptKategoria.findIndex(e => e.id == id);
                    if (i !== -1) $scope.receptKategoria[i].Torolve = 1;
                    $scope.showFeedback(true, "Törölve");
                });

        });
    };

    // ===== RESTORE =====
    $scope.visszaallitas = function (id) {

        $scope.openConfirm("Biztos visszaállítod?", function () {

            $http.patch("/CookQuest/admin/receptKategoriakAdmin/receptKatVisszaallitas.php", { id })
                .then(() => {
                    let i = $scope.receptKategoria.findIndex(e => e.id == id);
                    if (i !== -1) $scope.receptKategoria[i].Torolve = 0;
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
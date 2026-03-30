angular.module("CookQuestAdmin").controller("eszkozController", function ($scope, $http, $timeout) {

    // ADATBETÖLTÉS
    $http.get("/CookQuest/admin/lekerdezes/eszkoz.php")
        .then(function (response) {
            //console.log("ESZKÖZÖK:", response.data);
            $scope.eszkoz = response.data;

            if (window.location.search.indexOf("openNew=1") !== -1) {
                $scope.createEszkoz();
            }
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

    $http.get("/CookQuest/admin/lekerdezes/besorolas.php")
        .then(function (response) {
            //console.log("Besorolás:", response.data);
            $scope.besorolas = response.data;
        })
        .catch(function (err) {
            //console.error("Besorolás HIBA:", err);
        });

    // STATE
    $scope.selectedEszkoz = null;
    $scope.isModalOpen = false;
    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    $scope.confirmModal = false;
    $scope.confirmText = "";
    $scope.confirmAction = null;

    // EDIT
    $scope.editEszkoz = function (e) {
        $scope.selectedEszkoz = angular.copy(e);
        $scope.selectedEszkoz.BesorolasID = e.BesorolasID;

        $scope.isModalOpen = true;
    };

    // CREATE
    $scope.createEszkoz = function () {
        $scope.selectedEszkoz = {
            id: null,
            Nev: ""
        };
        $scope.isModalOpen = true;
    };

    // SAVE
    $scope.saveEszkoz = function () {
        console.log("EDIT:", $scope.selectedEszkoz);
        if (!$scope.selectedEszkoz.Nev || !$scope.selectedEszkoz.Nev.trim()) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Adj meg egy nevet!";
            $scope.feedbackMessage = true;
            return;
        }

        let url = $scope.selectedEszkoz.id
            ? "/CookQuest/admin/eszkozAdmin/eszkozModositas.php"
            : "/CookQuest/admin/eszkozAdmin/eszkozLetrehozas.php";

        $http({
            method: "POST",
            url: url,
            data: $scope.selectedEszkoz,
            headers: {
                "Content-Type": "application/json"
            }
        })
            .then(res => {

                console.log("BACKEND:", res.data);

                let response = res.data || {};
                let isSuccess = response.success === true || response.success === 1 || response.success === "1";

                if (!isSuccess) {
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = response.message || "Hiba történt.";
                    $scope.feedbackMessage = true;
                    console.error("Szerver hiba:", response);
                    return;
                }

                if ($scope.selectedEszkoz.id) {
                    // UPDATE
                    let index = $scope.eszkoz.findIndex(e => e.id == $scope.selectedEszkoz.id);
                    if (index !== -1) {
                        Object.assign($scope.eszkoz[index], $scope.selectedEszkoz);
                    }
                } else {
                    // CREATE
                    if (response.id) {
                        $scope.selectedEszkoz.id = response.id;
                    }
                    $scope.eszkoz.push(angular.copy($scope.selectedEszkoz));
                }

                $timeout(() => {
                    $scope.closeModal();
                }, 800);

                $scope.feedbackSuccess = true;
                $scope.feedbackText = "Mentve";
                $scope.feedbackMessage = true;

            })
            .catch(err => {
                console.error(err);
                $scope.feedbackSuccess = false;
                $scope.feedbackText = "Szerver hiba.";
                $scope.feedbackMessage = true;
            });
    };

    // DELETE
    $scope.torles = function (id) {

        $scope.openConfirm("Biztos törlöd ezt az eszközt?", function () {

            $http({
                method: "POST",
                url: "/CookQuest/admin/eszkozAdmin/eszkozTorles.php",
                data: { id: id },
                headers: {
                    "Content-Type": "application/json"
                }
            })
                .then(() => {

                    let index = $scope.eszkoz.findIndex(e => e.id == id);
                    if (index !== -1) {
                        $scope.eszkoz[index].Torolve = 1;
                    }

                    $scope.feedbackSuccess = true;
                    $scope.feedbackText = "Törölve";
                    $scope.feedbackMessage = true;

                })
                .catch(() => {
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = "Hiba történt.";
                    $scope.feedbackMessage = true;
                });

        });
    };

    // RESTORE
    $scope.visszaallitas = function (id) {

        $scope.openConfirm("Biztosan visszaállítod?", function () {

            $http.get("/CookQuest/admin/eszkozAdmin/eszkozVisszaallitas.php?id=" + id)
                .then(res => {

                    if (res.data.success) {
                        let index = $scope.eszkoz.findIndex(e => e.id == id);
                        if (index !== -1) {
                            $scope.eszkoz[index].Torolve = 0;
                        }

                        $scope.feedbackSuccess = true;
                        $scope.feedbackText = "Visszaállítva";
                        $scope.feedbackMessage = true;
                    } else {
                        $scope.feedbackSuccess = false;
                        $scope.feedbackText = res.data.message || "Hiba történt.";
                        $scope.feedbackMessage = true;
                    }

                })
                .catch(() => {
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = "Hiba történt.";
                    $scope.feedbackMessage = true;
                });

        });
    };

    // FEEDBACK
    $scope.closeFeedbackMessage = function () {
        $scope.feedbackMessage = false;
        $scope.feedbackText = "";
        $scope.feedbackSuccess = false;
    };

    // MODAL
    $scope.closeModal = function () {
        $scope.isModalOpen = false;
    };

    // CONFIRM
    $scope.openConfirm = function (text, action) {
        $scope.confirmText = text;
        $scope.confirmAction = action;
        $scope.confirmModal = true;
    };

    $scope.confirmOk = function () {
        if ($scope.confirmAction) {
            $scope.confirmAction();
        }
        $scope.confirmModal = false;
    };

    $scope.confirmCancel = function () {
        $scope.confirmModal = false;
    };

});
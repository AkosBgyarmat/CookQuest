angular.module("CookQuestAdmin").controller("hozzavaloController", function ($scope, $http) {

    // ADATOK BETÖLTÉSE
    $http.get("/CookQuest/admin/lekerdezes/hozzavalok.php")
        .then(function (response) {
            $scope.hozzavalo = response.data;

            if (window.location.search.indexOf("openNew=1") !== -1) {
                $scope.createHozzavalo();
            }
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });


    $scope.selectedHozzavalo = null;
    $scope.isModalOpen = false;
    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    $scope.confirmModal = false;
    $scope.confirmText = "";
    $scope.confirmAction = null;

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

    $scope.editHozzavalo = function (h) {
        //console.log("KATTINTOTTÁL", h);
        $scope.selectedHozzavalo = h ? angular.copy(h) : {
            id: null,
            Elnevezes: ""
        };

        $scope.isModalOpen = true;
    };

    $scope.createHozzavalo = function () {
        $scope.selectedHozzavalo = {
            id: null,
            Elnevezes: ""
        };

        $scope.isModalOpen = true;
    };

    $scope.closeModal = function () {
        $scope.isModalOpen = false;
    };

    $scope.closeFeedbackMessage = function () {
        $scope.feedbackMessage = false;
        $scope.feedbackText = "";
        $scope.feedbackSuccess = false;
    };

    if (window.location.search.indexOf("openNew=1") !== -1) {
        $scope.createHozzavalo();
    }

    $scope.saveHozzavalo = function () {

        if (!$scope.selectedHozzavalo.Elnevezes || !$scope.selectedHozzavalo.Elnevezes.trim()) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Adj meg egy nevet!";
            $scope.feedbackMessage = true;
            return;
        }

        let url = $scope.selectedHozzavalo.id
            ? "/CookQuest/admin/hozzavalokAdmin/hozzavaloModositas.php"
            : "/CookQuest/admin/hozzavalokAdmin/hozzavaloLetrehozas.php";

        $http({
            method: "POST",
            url: url,
            data: $scope.selectedHozzavalo,
            headers: {
                "Content-Type": "application/json"
            }
        })
            .then(res => {

                let response = res.data || {};
                let isSuccess = response.success === true || response.success === 1 || response.success === "1";

                if (!isSuccess) {
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = response.message || "Hiba történt.";
                    $scope.feedbackMessage = true;
                    return;
                }

                if ($scope.selectedHozzavalo.id) {
                    // UPDATE
                    let index = $scope.hozzavalo.findIndex(h => h.id == $scope.selectedHozzavalo.id);
                    if (index !== -1) {
                        Object.assign($scope.hozzavalo[index], $scope.selectedHozzavalo);
                    }
                } else {
                    // CREATE
                    if (response.id) {
                        $scope.selectedHozzavalo.id = response.id;
                    }
                    $scope.hozzavalo.push(angular.copy($scope.selectedHozzavalo));
                }

                $scope.closeModal();
                $scope.feedbackSuccess = true;
                $scope.feedbackText = "A hozzávaló mentése sikeresen megtörtént.";
                $scope.feedbackMessage = true;

            })
            .catch(err => {
                console.error(err);
                $scope.feedbackSuccess = false;
                $scope.feedbackText = "Szerver hiba.";
                $scope.feedbackMessage = true;
            });
    };

    $scope.torles = function (id) {

        $scope.openConfirm("Biztos törlöd ezt a hozzávalót? Ezzel minden ehhez kapcsolódó receptet is archiválsz!", function () {
    
            $http({
                method: "POST",
                url: "/CookQuest/admin/hozzavalokAdmin/hozzavaloTorles.php",
                data: { id: id },
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(() => {
    
                let index = $scope.hozzavalo.findIndex(h => h.id == id);
                if (index !== -1) {
                    $scope.hozzavalo[index].Torolve = 1;
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

    $scope.visszaallitas = function (id) {

        $http.get("/CookQuest/admin/hozzavalokAdmin/hozzavaloVisszaallitas.php?id=" + id)
            .then(res => {

                if (res.data.success) {
                    let index = $scope.hozzavalo.findIndex(h => h.id == id);
                    if (index !== -1) {
                        $scope.hozzavalo[index].Torolve = 0;
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
                $scope.feedbackText = "Szerver hiba.";
                $scope.feedbackMessage = true;
            });
    };

});
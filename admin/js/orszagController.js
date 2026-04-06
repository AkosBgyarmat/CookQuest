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
    $scope.selectedOrszag = null;
    $scope.isModalOpen = false;

    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    if (window.location.search.indexOf("openNew=1") !== -1) {
        $scope.createOrszag();
    }

    $scope.closeModal = function () {
        $scope.isModalOpen = false;
    };

    $scope.closeFeedbackMessage = function () {
        $scope.feedbackMessage = false;
        $scope.feedbackText = "";
        $scope.feedbackSuccess = false;
    };

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


    // 🔹 CREATE
    $scope.createOrszag = function () {
        $scope.selectedOrszag = {
            Id: null,
            Nev: "",
            Torolve: 0
        };
        $scope.isModalOpen = true;
    };

    // 🔹 EDIT
    $scope.editOrszag = function (o) {
        $scope.selectedOrszag = angular.copy(o);
        $scope.isModalOpen = true;
    };

    // 🔹 SAVE
    $scope.saveOrszag = function () {

        if (!$scope.selectedOrszag.Nev) {
            $scope.feedbackText = "Adj meg nevet!";
            $scope.feedbackSuccess = false;
            $scope.feedbackMessage = true;
            return;
        }

        let isUpdate = $scope.selectedOrszag.Id != null;

        let url = isUpdate
            ? "/CookQuest/admin/orszagAdmin/orszagModositas.php"
            : "/CookQuest/admin/orszagAdmin/orszagLetrehozas.php";

        let method = isUpdate ? "PATCH" : "POST";

        $http({
            method: method,
            url: url,
            data: $scope.selectedOrszag,
            headers: { "Content-Type": "application/json" }
        })
            .then(res => {

                if (!res.data.success) throw new Error();

                if (isUpdate) {
                    let index = $scope.orszagok.findIndex(o => o.Id == $scope.selectedOrszag.Id);
                    if (index !== -1) {
                        Object.assign($scope.orszagok[index], $scope.selectedOrszag);
                    }
                } else {
                    $scope.selectedOrszag.Id = res.data.id;
                    $scope.orszagok.push(angular.copy($scope.selectedOrszag));
                }

                $scope.closeModal();
                $scope.feedbackSuccess = true;
                $scope.feedbackText = "Mentve!";
                $scope.feedbackMessage = true;

            })
            .catch(() => {
                $scope.feedbackSuccess = false;
                $scope.feedbackText = "Hiba történt.";
                $scope.feedbackMessage = true;
            });
    };

    // 🔹 DELETE (soft)
    $scope.deleteOrszag = function (id) {

        $scope.openConfirm("Biztosan törölni szeretnéd?", function () {

            $http.delete("/CookQuest/admin/orszagAdmin/orszagTorles.php?id=" + id)
                .then(() => {

                    let index = $scope.orszagok.findIndex(o => o.Id == id);
                    if (index !== -1) {
                        $scope.orszagok[index].Torolve = 1;
                    }

                    $scope.feedbackSuccess = true;
                    $scope.feedbackText = "Törölve!";
                    $scope.feedbackMessage = true;

                });
        });
    };

    // 🔹 VISSZAÁLLÍTÁS
    $scope.visszaallitas = function (id) {

        $http({
            method: "PATCH",
            url: "/CookQuest/admin/orszagAdmin/orszagVisszaallitas.php",
            data: { id: id },
            headers: { "Content-Type": "application/json" }
        })
            .then(() => {

                let index = $scope.orszagok.findIndex(o => o.Id == id);
                if (index !== -1) {
                    $scope.orszagok[index].Torolve = 0;
                }

                $scope.feedbackSuccess = true;
                $scope.feedbackText = "Visszaállítva!";
                $scope.feedbackMessage = true;

            });
    };

});
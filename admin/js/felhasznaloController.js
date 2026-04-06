angular.module("CookQuestAdmin").controller("felhasznaloController", function ($scope, $http) {

    //adatbetöltés - felhasználók
    $http.get("/CookQuest/admin/lekerdezes/felhasznalo.php")
        .then(response => {
            response.data.forEach(f => {
                f.SzuletesiEv = parseInt(f.SzuletesiEv) || null;
                f.RegisztracioEve = parseInt(f.RegisztracioEve) || null;
                f.MegszerzettPontok = parseInt(f.MegszerzettPontok) || 0;
            });
            //console.log("RECEPTEK:", response.data);
            $scope.felhasznalok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
    });

    //adatbetöltés - országok 
    $http.get("/CookQuest/admin/lekerdezes/orszag.php")
        .then(function (response) {
            //console.log("ORSZÁGOK:", response.data);
            $scope.orszagok = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
    });

    console.log($scope.selectedFelhasznalo);

    //adabetöltés - szerepek
    $http.get("/CookQuest/admin/lekerdezes/szerepek.php")
        .then(function (response) {
            //console.log("SZEREPEK:", response.data);
            $scope.szerepek = response.data;
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

    $scope.selectedFelhasznalo = null;
    $scope.isModalOpen = false;
    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    $scope.confirmModal = false;
    $scope.confirmText = "";
    $scope.confirmAction = null;

    if (window.location.search.indexOf("openNew=1") !== -1) {
        $scope.createFelhasznalo();
    }

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

    $scope.closeModal = function () {
        $scope.isModalOpen = false;
    };

    $scope.closeFeedbackMessage = function () {
        $scope.feedbackMessage = false;
        $scope.feedbackText = "";
        $scope.feedbackSuccess = false;
    };

    $scope.confirmCancel = function () {
        $scope.confirmModal = false;
    };

    $scope.editFelhasznalo = function (f) {
        console.log("KATTINTOTTÁL", f);

        $scope.selectedFelhasznalo = f ? angular.copy(f) : {
            id: null,
            Vezeteknev: "",
            Keresztnev: "",
            Felhasznalonev: "",
            Emailcim: "",
            SzuletesiEv: "",
            Orszag: "",
            RegisztracioEve: "",
            MegszerzettPontok: "",
            Szerep: "",
            Torolve: 0,
            Jelszo: ""
        }

        let orszag = $scope.orszagok.find(o => o.Nev === f.Orszag);
        if (orszag) {
            $scope.selectedFelhasznalo.OrszagID = orszag.Id;
        }

        let szerep = $scope.szerepek.find(sz => sz.Szerep === f.Szerep);
        if (szerep) {
            $scope.selectedFelhasznalo.SzerepID = szerep.Id;
        }

        $scope.isModalOpen = true;
    };

    $scope.createFelhasznalo = function () {
        $scope.selectedFelhasznalo = {
            id: null,
            Vezeteknev: "",
            Keresztnev: "",
            Felhasznalonev: "",
            Emailcim: "",
            SzuletesiEv: "",
            OrszagID: null,
            RegisztracioEve: new Date().getFullYear(),
            MegszerzettPontok: 0,
            SzerepID: null,
            Torolve: 0,
            Jelszo: ""
        };

        $scope.selectedFelhasznalo.nextId = $scope.felhasznalok.reduce((maxId, f) => Math.max(maxId, f.id), 0) + 1;

        $scope.isModalOpen = true;
    };

    $scope.saveFelhasznalo = function () {

        if (!$scope.selectedFelhasznalo.OrszagID == null) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Válassz országot!";
            $scope.feedbackMessage = true;
            return;
        }

        if (!$scope.selectedFelhasznalo.SzerepID == null) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Válassz szerepet!";
            $scope.feedbackMessage = true;
            return;
        }

        if (!$scope.selectedFelhasznalo.Jelszo) {
            delete $scope.selectedFelhasznalo.Jelszo;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($scope.selectedFelhasznalo.Emailcim)) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Adj meg egy érvényes emailcímet!";
            $scope.feedbackMessage = true;
            return;
        }

        let url = $scope.selectedFelhasznalo.id
            ? "/CookQuest/admin/felhasznaloAdmin/felhasznaloModositas.php"
            : "/CookQuest/admin/felhasznaloAdmin/felhasznaloLetrehozas.php";

        let method = $scope.selectedFelhasznalo.id ? "PATCH" : "POST";

        $http({
            method: method,
            url: url,
            data: $scope.selectedFelhasznalo,
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

                if ($scope.selectedFelhasznalo.id) {
                    // UPDATE
                    let index = $scope.felhasznalok.findIndex(f => f.id == $scope.selectedFelhasznalo.id);
                    if (index !== -1) {
                        Object.assign($scope.felhasznalok[index], $scope.selectedFelhasznalo);
                    }
                } else {
                    // CREATE
                    if (response.id) {
                        $scope.selectedFelhasznalo.id = response.id;
                    }
                    $scope.felhasznalok.push(angular.copy($scope.selectedFelhasznalo));
                }

                $scope.closeModal();
                $scope.feedbackSuccess = true;
                $scope.feedbackText = "A felhasználó mentése sikeresen megtörtént.";
                $scope.feedbackMessage = true;

            })
            .catch(err => {
                console.error(err);
                $scope.feedbackSuccess = false;
                $scope.feedbackText = "Szerver hiba.";
                $scope.feedbackMessage = true;
            });
    };

    $scope.deleteFelhasznalo = function (id) {

        $scope.openConfirm("Biztos törlöd ezt a felhasználót?", function () {

            $http.delete("/CookQuest/admin/felhasznaloAdmin/felhasznaloTorles.php?id=" + id)
                .then(res => {

                    let index = $scope.felhasznalok.findIndex(f => f.id == id);
                    if (index !== -1) {
                        $scope.felhasznalok[index].Torolve = 1;
                    }

                    $scope.feedbackSuccess = true;
                    $scope.feedbackText = "Felhasználó törölve.";
                    $scope.feedbackMessage = true;

                })
                .catch(err => {
                    console.error(err);
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = "Hiba történt törlés közben.";
                    $scope.feedbackMessage = true;
                });

        });
    };

    $scope.visszaallitas = function (id) {

        $scope.openConfirm("Biztos visszaállítod?", function () {

            $http({
                method: "PATCH",
                url: "/CookQuest/admin/felhasznaloAdmin/felhasznaloVisszaallitas.php",
                data: { id: id },
                headers: {
                    "Content-Type": "application/json"
                }
            })
                .then(res => {

                    let index = $scope.felhasznalok.findIndex(f => f.id == id);
                    if (index !== -1) {
                        $scope.felhasznalok[index].Torolve = 0;
                    }

                    $scope.feedbackSuccess = true;
                    $scope.feedbackText = "Felhasználó visszaállítva.";
                    $scope.feedbackMessage = true;

                })
                .catch(err => {
                    console.error(err);
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = "Hiba történt visszaállítás közben.";
                    $scope.feedbackMessage = true;
                });

        });
    };
});
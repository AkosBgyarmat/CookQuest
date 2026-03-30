angular.module("CookQuestAdmin").controller("receptController", function ($scope, $http, $timeout) {

    //adatbetöltés
    $http.get("/CookQuest/admin/lekerdezes/recept.php")
        .then(function (response) {
            //console.log("RECEPTEK:", response.data);
            $scope.recept = response.data;

            if (window.location.search.indexOf("openNew=1") !== -1) {
                $scope.createRecept();
            }
        })
        .catch(function (error) {
            console.error("Nem sikerült:", error);
        });

    $http.get("/CookQuest/admin/lekerdezes/arkategoria.php")
        .then(function (response) {
            //console.log("ARKATEGORIA:", response.data);
            $scope.arkategoriak = response.data;
        })
        .catch(function (err) {
            //console.error("ARKATEGORIA HIBA:", err);
        });

    $http.get("/CookQuest/admin/lekerdezes/alkategoria.php").then(res => {
        $scope.alkategoriak = res.data;
    });

    $http.get("/CookQuest/admin/lekerdezes/nehezsegiszint.php").then(res => {
        res.data.forEach(n => {
            n.NehezsegiSzintID = Number(n.NehezsegiSzintID);
        });

        $scope.nehezsegek = res.data;

    });

    $http.get("/CookQuest/admin/lekerdezes/elkeszitesiMod.php").then(res => {
        $scope.elkeszitesiModok = res.data;
    });

    $http.get("/CookQuest/admin/lekerdezes/hozzavalok.php")
        .then(res => {
            $scope.osszesHozzavalo = res.data.map(h => ({
                HozzavaloID: Number(h.id),
                Nev: h.Elnevezes
            }));
            //console.log($scope.osszesHozzavalo);
        });

    $http.get("/CookQuest/admin/lekerdezes/mertekegyseg.php")
        .then(res => {
            $scope.osszesMertekegyseg = res.data;
        });



    $scope.selectedRecept = null;
    $scope.isModalOpen = false;
    $scope.feedbackMessage = false;
    $scope.feedbackSuccess = false;
    $scope.feedbackText = "";

    $scope.getNextReceptId = function () {
        if (!$scope.recept || !$scope.recept.length) {
            return 1;
        }
        let maxId = Math.max.apply(null, $scope.recept.map(r => Number(r.id) || 0));
        return maxId + 1;
    };

    $scope.closeFeedbackMessage = function () {
        $scope.feedbackMessage = false;
        $scope.feedbackSuccess = false;
        $scope.feedbackText = "";
    };

    $scope.addHozzavalo = function () {
        $scope.selectedRecept.hozzavalok.push({
            HozzavaloID: null,
            Mennyiseg: 0,
            MertekegysegID: null
        });
    };

    $scope.removeHozzavalo = function (index) {
        $scope.selectedRecept.hozzavalok.splice(index, 1);
    };

    $scope.editRecept = function (r) {
        $scope.selectedRecept = angular.copy(r);
        $scope.selectedRecept.hozzavalok = [];
        console.log($scope.selectedRecept);

        $http.get("/CookQuest/admin/lekerdezes/receptHozzavalo.php?receptID=" + r.id)
            .then(res => {
                res.data.forEach(h => {
                    h.Mennyiseg = parseFloat(h.Mennyiseg) || 0;

                    h.selectedHozzavalo = $scope.osszesHozzavalo.find(x =>
                        x.HozzavaloID == h.HozzavaloID
                    );

                    h.selectedMertekegyseg = $scope.osszesMertekegyseg.find(m =>
                        m.MertekegysegID == h.MertekegysegID
                    );
                });
                $timeout(() => {
                    $scope.selectedRecept.hozzavalok = res.data;
                });

            });

        $scope.selectedRecept.Adag = parseInt(r.Adag) || 0;
        $scope.selectedRecept.NehezsegiSzintID = Number(r.NehezsegiSzintID);
        $scope.selectedRecept.BegyujthetoPontok = parseInt(r.BegyujthetoPontok) || 0;
        $scope.selectedRecept.Kaloria = parseFloat(r.Kaloria) || 0;

        if (typeof r.ElkeszitesiIdo === "string" && r.ElkeszitesiIdo.includes(':')) {
            let parts = r.ElkeszitesiIdo.split(':');

            let date = new Date();

            date.setHours(parseInt(parts[0]) || 0);
            date.setMinutes(parseInt(parts[1]) || 0);
            date.setSeconds(0);
            date.setMilliseconds(0);

            $scope.selectedRecept.ElkeszitesiIdo = date;
        } else {
            $scope.selectedRecept.ElkeszitesiIdo = null;
        }

        if (r.Kep) {
            $scope.selectedRecept.Kep = r.Kep.trim();
        }

        $scope.isModalOpen = true;
    };

    $scope.closeModal = function () {
        $scope.isModalOpen = false;
    };

    $scope.createRecept = function () {
        let date = new Date();
        date.setHours(0);
        date.setMinutes(0);
        date.setSeconds(0);
        date.setMilliseconds(0);

        $scope.selectedRecept = {
            id: null,
            nextId: $scope.getNextReceptId(),
            Nev: "",
            Kategoria: "",
            Alkategoria: "",
            ElkeszitesiIdo: date,
            Nehezseg: 1,
            Kep: "",
            Adag: 1,
            BegyujthetoPontok: 0,
            Kaloria: 0,
            ArkategoriaID: null,
            ElkeszitesiMod: "",
            Elkeszitesi_leiras: "",

            hozzavalok: []
        };

        $scope.isModalOpen = true;
    };

    // Ha a receptek oldalra query parammal érkezünk, automatikusan nyissa meg az új recept modalt
    if (window.location.search.indexOf("openNew=1") !== -1) {
        $scope.createRecept();
    }

    $scope.saveRecept = function () {
        let payload = angular.copy($scope.selectedRecept);

        let requiredFields = [];
        if (!payload.Nev || !payload.Nev.trim()) requiredFields.push("Név");
        if (!payload.AlkategoriaID) requiredFields.push("Alkategória");
        if (!payload.ElkeszitesiModID) requiredFields.push("Elkészítési mód");
        if (!payload.ArkategoriaID) requiredFields.push("Árkategória");
        if (!payload.Elkeszitesi_leiras || !payload.Elkeszitesi_leiras.trim()) requiredFields.push("Leírás");
        if (!payload.Adag || isNaN(payload.Adag) || Number(payload.Adag) <= 0) requiredFields.push("Adag");

        if (requiredFields.length) {
            $scope.feedbackSuccess = false;
            $scope.feedbackText = "Kérlek töltsd ki: " + requiredFields.join(", ") + ".";
            $scope.feedbackMessage = true;
            return;
        }

        if (payload.ElkeszitesiIdo instanceof Date) {
            let d = payload.ElkeszitesiIdo;
            let hours = String(d.getHours()).padStart(2, '0');
            let minutes = String(d.getMinutes()).padStart(2, '0');
            payload.ElkeszitesiIdo = `${hours}:${minutes}:00`;
        } else if (typeof payload.ElkeszitesiIdo === "string") {
            let parts = payload.ElkeszitesiIdo.split(":");
            if (parts.length >= 2) {
                let hours = String(parseInt(parts[0]) || 0).padStart(2, '0');
                let minutes = String(parseInt(parts[1]) || 0).padStart(2, '0');
                payload.ElkeszitesiIdo = `${hours}:${minutes}:00`;
            }
        } else {
            payload.ElkeszitesiIdo = "00:00:00";
        }

        console.log("MENTÉS ADAT:", payload);

        let url = $scope.selectedRecept.id
            ? "/CookQuest/admin/mentesek/receptModositas.php"
            : "/CookQuest/admin/mentesek/receptLetrehozas.php";

        $http({
            method: "POST",
            url: url,
            data: payload,
            headers: {
                "Content-Type": "application/json"
            }
        })
            .then(function (res) {

                console.log("Siker:", res.data);

                let response = res.data || {};
                let isSuccess = typeof response.success === "undefined" 
                    ? true 
                    : (response.success === true || response.success === 1 || response.success === "1");

                if (!isSuccess) {
                    $scope.feedbackSuccess = false;
                    $scope.feedbackText = response.message || "A mentés nem sikerült.";
                    $scope.feedbackMessage = true;
                    return;
                }

                let displayRecept = angular.copy($scope.selectedRecept);
                if (displayRecept.ElkeszitesiIdo instanceof Date) {
                    let d = displayRecept.ElkeszitesiIdo;
                    let hours = String(d.getHours()).padStart(2, '0');
                    let minutes = String(d.getMinutes()).padStart(2, '0');
                    displayRecept.ElkeszitesiIdo = `${hours}:${minutes}:00`;
                }

                if ($scope.selectedRecept.id) {
                    let index = $scope.recept.findIndex(r => r.id == $scope.selectedRecept.id);

                    if (index !== -1) {
                        Object.assign($scope.recept[index], displayRecept);
                    }

                } else {
                    if (typeof response.id !== "undefined") {
                        $scope.selectedRecept.id = response.id;
                        displayRecept.id = response.id;
                    }
                    $scope.recept.push(displayRecept);
                }

                $scope.closeModal();
                $scope.feedbackSuccess = true;
                $scope.feedbackText = "A recept mentése sikeresen megtörtént.";
                $scope.feedbackMessage = true;
            })
            .catch(err => {
                console.error("Mentési hiba:", err);
                $scope.feedbackSuccess = false;
                $scope.feedbackText = (err.data && err.data.message) ? err.data.message : "Hiba történt a mentés során.";
                $scope.feedbackMessage = true;
            });
    };

});
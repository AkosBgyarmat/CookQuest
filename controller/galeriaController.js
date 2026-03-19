angular.module("CookQuest").controller("galleryController", function ($scope) {

    const etelek = [
        "/CookQuest/assets/kepek/etelek/bundasKenyer.webp",
        "/CookQuest/assets/kepek/etelek/ZoldsegLeves.webp",
        "/CookQuest/assets/kepek/etelek/Palacsinta.webp",
        "/CookQuest/assets/kepek/etelek/ZabpelyhesMezesPohardesszert.webp",
        "/CookQuest/assets/kepek/etelek/TukorTojas.webp",
        "/CookQuest/assets/kepek/etelek/GyumolcsosPohardesszert.webp"
    ];

    const eszkozok = [
        "/CookQuest/assets/kepek/konyhaiEszkoz/airfryer.jpg",
        "/CookQuest/assets/kepek/konyhaiEszkoz/bogracs.jpg",
        "/CookQuest/assets/kepek/konyhaiEszkoz/ecset.jpg",
        "/CookQuest/assets/kepek/konyhaiEszkoz/hamozo.jpg"
    ];

    const allImages = [...etelek, ...eszkozok];

    function shuffle(array) {
        return array.sort(() => 0.5 - Math.random());
    }

    $scope.randomImages = shuffle(allImages).slice(0, 6);

    $scope.isMobile = window.innerWidth < 640;

    window.addEventListener("resize", function () {
        $scope.$apply(function () {
            $scope.isMobile = window.innerWidth < 640;
        });
    });

});
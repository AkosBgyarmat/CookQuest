angular.module("CookQuest").controller("galleryController", function ($scope) {

    const etelek = [
        "../../assets/kepek/etelek/bundasKenyer.webp",
        "../../assets/kepek/etelek/ZoldsegLeves.webp",
        "../../assets/kepek/etelek/Palacsinta.webp",
        "../../assets/kepek/etelek/ZabpelyhesMezesPohardesszert.webp",
        "../../assets/kepek/etelek/TukorTojas.webp",
        "../../assets/kepek/etelek/GyumolcsosPohardesszert.webp"
    ];

    const eszkozok = [
        "../../assets/kepek/konyhaiEszkoz/airfryer.jpg",
        "../../assets/kepek/konyhaiEszkoz/bogracs.jpg",
        "../../assets/kepek/konyhaiEszkoz/ecset.jpg",
        "../../assets/kepek/konyhaiEszkoz/hamozo.jpg"
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
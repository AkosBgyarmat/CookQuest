<?php
session_start();

require_once __DIR__ . '/../../api/receptek_bootstrap.php';
require_once __DIR__ . '/../../controller/IndexOldalRecept.php';
include "../head.php";
?>

<main>
    <!-- hero seciton -->
    <section class="relative w-full h-[320px]">

        <!-- Háttérkép -->
        <div class="absolute inset-0">
            <img src="../../assets/kepek/fooldalHero.jpg"
                alt="Konyha"
                class="object-cover object-center w-full h-full opacity-60" />
        </div>

        <!-- Tartalom -->
        <div class="absolute inset-0 flex items-center justify-center md:justify-start px-4 md:px-12">

            <div class="w-full md:w-1/2 
                    bg-white/80 md:bg-transparent 
                    backdrop-blur-sm 
                    md:backdrop-blur-0
                    p-6 md:p-0 
                    rounded-xl md:rounded-none 
                    shadow-md md:shadow-none">

                <h1 class="text-black font-medium text-3xl md:text-5xl leading-tight mb-4">
                    CookQuest
                </h1>

                <p class="text-gray text-base md:text-xl mb-6">
                    Meg szeretnél tanulni főzni? Itt a tökéletes alkalom, hogy lépésről lépésre elsajátíts mindent.
                </p>

                <a href="../receptek/receptek.php"
                    class="inline-block px-6 py-3 bg-[#5A7863] text-white font-medium rounded-full hover:bg-[#EBF4DD] hover:text-black transition duration-200">
                    Kezdj hozzá most!
                </a>

            </div>

        </div>

    </section>
    <!-- Az első szint receptjei, ez bejelentkezés nélkül is megtekinthető de nem kapható érte pont. -->
    <section class="py-10 ">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Próbáld ki néhány receptünket</h2>
            <div id="indexReceptekContainer" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            </div>
            <script id="indexReceptekData" type="application/json"><?= json_encode($indexReceptek, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
        </div>
    </section>

    <!-- Rólunk néhány szó -->
    <section class="bg-[#EBF4DD]">
        <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Rólunk</h2>
                    <p class="mt-4 text-gray-600 text-lg text-justify">
                        Ezt az oldalt ketten készítjük, azzal a céllal, hogy segítsünk azoknak, akik nulláról szeretnének megtanulni főzni. Úgy gondoljuk, hogy a főzés nem kell, hogy bonyolult vagy ijesztő legyen – csak érthető lépésekre és egy kis gyakorlásra van szükség.
                        <br>
                        Az oldalon olyan tartalmakat gyűjtünk össze, amelyek az alapoktól indulnak: egyszerű technikák, jól követhető receptek és hasznos konyhai tippek. Minden leírás úgy készült, hogy könnyű legyen követni akkor is, ha valaki most áll először a tűzhely mellé.
                        <br>
                        A célunk egy olyan oldal létrehozása, ahol a tanulás nem stresszes, hanem élvezhető, és ahol a főzés fokozatosan válik magabiztos rutinná.
                    </p>
                </div>
                <div class="mt-12 md:mt-0 ">
                    <img src="../../assets/kepek/rolunk.png" alt="About Us Image"
                        class="w-full max-w-[450px] h-auto object-cover rounded-lg shadow-md mx-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Galéria -->
    <section class="text-gray-700 body-font" ng-controller="galleryController">
        <div class="flex justify-center text-3xl font-bold text-gray-800 text-center py-10">
            Galéria
        </div>

        <div class="grid grid-cols-1 place-items-center mb-10 
                sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 
                gap-4 p-4">

            <div class="group relative" ng-repeat="image in randomImages | limitTo: (isMobile ? 3 : 6)">
                <img ng-src="{{image}}"
                    class="aspect-[2/3] h-80 object-cover rounded-lg 
                       transition-transform transform scale-100 
                       group-hover:scale-105" />
            </div>

        </div>
    </section>

    <div id="cookieBanner"
        class="fixed left-1/2 -translate-x-1/2 bottom-6
            bg-black/70 backdrop-blur-md
            text-white
            px-6 py-4
            rounded-xl
            shadow-2xl
            hidden
            z-50
            flex items-center gap-4">

        <span>Ez az oldal sütiket használ. Ha kérdése van olvasson tovább a <a class="underline" href="../jogiInformaciok/cookieTajekoztato.php">Cookie tájékoztató</a> oldalon.</span>

        <button onclick="acceptCookies()"
            class="bg-white text-black px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            Elfogadom
        </button>
    </div>

</main>

<?php include("../footer.php") ?>
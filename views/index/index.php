<?php
session_start();
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-1 gap-6">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
                        <div class="relative overflow-hidden">
                            <img src="../../assets/kepek/etelek/PiritosKenyer.webp"
                                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                alt="">
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-sm text-[#596C68] font-bold">⭐ </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
                                    . SZINT
                                </span>
                            </div>

                            <h3 class="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">

                            </h3>

                            <div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>
                                        <span>perc</span>
                                </div>
                            </div>

                            <a class="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm">
                                Recept megtekintése
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-1 gap-6">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
                        <div class="relative overflow-hidden">
                            <img src="../../assets/kepek/etelek/GyumolcsosPohardesszert.webp"
                                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                alt="">
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-sm text-[#596C68] font-bold">⭐ </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
                                    . SZINT
                                </span>
                            </div>

                            <h3 class="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">

                            </h3>

                            <div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>
                                        <span>perc</span>
                                </div>
                            </div>

                            <a class="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm">
                                Recept megtekintése
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-1 gap-6">
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="../../assets/kepek/etelek/PiritosKenyer.webp"
                                class="w-full h-48 object-cover"
                                alt="">
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-sm text-[#596C68] font-bold">⭐ </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
                                    . SZINT
                                </span>
                            </div>

                            <h3 class="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">

                            </h3>

                            <div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>
                                        <span>perc</span>
                                </div>
                            </div>

                            <a class="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm">
                                Recept megtekintése
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
</main>

<?php include("../footer.php") ?>
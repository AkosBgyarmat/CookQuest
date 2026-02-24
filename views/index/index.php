<?php 
    session_start();
    include "../head.php"; 
?>

<main>
    <!-- hero seciton -->
    <section class="relative w-full h-[320px]">

        <div class="absolute inset-0">
            <img src="../../assets/kepek/fooldalHero.jpg" alt="Konyha" class="object-cover object-center w-full h-full opacity-50" />
        </div>

        <div class="absolute inset-9 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-4 md:mb-0">
                <h1 class="text-black font-medium text-4xl md:text-5xl leading-tight mb-2">CookQuest</h1>
                <p class="font-regular text-xl mb-8 mt-4">Meg szeretnél tanulni főzni? Itt a tökéletes alkalom, hogy lépésről lépésre elsajátíts mindent.</p>
                <a href="../receptek/receptek.php"
                    class="px-6 py-3 bg-[#5A7863] text-white font-medium rounded-full hover:bg-[#EBF4DD] hover:text-black transition duration-200">Kezdj hozzá most!</a>
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

    <!-- Miért velünk tanulj?  -->
    <!--
    <section class="text-gray-700 body-font mt-10">

        <div class="flex justify-center text-3xl font-bold text-gray-800 text-center py-5">
            Miért velünk tanulj?
        </div>

        <div class="container px-5 py-5 mx-auto">
            <div class="flex flex-wrap text-center justify-center">
                <div class="p-4 md:w-1/4 sm:w-1/2">
                    <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                        <div class="flex justify-center">
                            <img src="https://image3.jdomni.in/banner/13062021/58/97/7C/E53960D1295621EFCB5B13F335_1623567851299.png?output-format=webp" class="w-32 mb-3">
                        </div>
                        <h2 class="title-font font-regular text-2xl text-gray-900">Korszerű technológiák alkalmazása</h2>
                    </div>
                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2">
                    <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                        <div class="flex justify-center">
                            <img src="https://image2.jdomni.in/banner/13062021/3E/57/E8/1D6E23DD7E12571705CAC761E7_1623567977295.png?output-format=webp" class="w-32 mb-3">
                        </div>
                        <h2 class="title-font font-regular text-2xl text-gray-900">Kölcséghatékony<br> receptek</h2>
                    </div>
                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2">
                    <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                        <div class="flex justify-center">
                            <img src="https://image3.jdomni.in/banner/13062021/16/7E/7E/5A9920439E52EF309F27B43EEB_1623568010437.png?output-format=webp"
                                class="w-32 mb-3">
                        </div>
                        <h2 class="title-font font-regular text-2xl text-gray-900">Időhatékony</h2>
                    </div>
                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2">
                    <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                        <div class="flex justify-center">
                            <img src="https://image3.jdomni.in/banner/13062021/EB/99/EE/8B46027500E987A5142ECC1CE1_1623567959360.png?output-format=webp"
                                class="w-32 mb-3">
                        </div>
                        <h2 class="title-font font-regular text-2xl text-gray-900">Megbízható források</h2>
                    </div>
                </div>

            </div>
        </div>
    </section> -->

    <!-- Galéria -->
    <section class="text-gray-700 body-font">
        <div class="flex justify-center text-3xl font-bold text-gray-800 text-center py-10">
            Galéria
        </div>

        <div class="grid grid-cols-1 place-items-center mb-10 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-6 gap-4 p-4">

            <div class="group relative">
                <img src="../../assets/kepek/etelek/bundasKenyer.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>

            <div class="group relative">
                <img src="../../assets/kepek/etelek/ZoldsegLeves.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>

            <div class="group relative">
                <img src="../../assets/kepek/etelek/Palacsinta.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>

            <div class="group relative">
                <img src="../../assets/kepek/etelek/ZabpelyhesMezesPohardesszert.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>

            <div class="group relative">
                <img src="../../assets/kepek/etelek/TukorTojas.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>

            <div class="group relative">
                <img src="../../assets/kepek/etelek/GyumolcsosPohardesszert.webp"
                    alt="Image 1"
                    class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105" />
            </div>
        </div>

    </section>
</main>

<?php include("../footer.php") ?>
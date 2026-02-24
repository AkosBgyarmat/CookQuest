<?php
session_start();
include "../head.php";
?>


<section ng-controller="eszkozCtrl" ng-cloak>

    <!-- HERO & MINI NAVBAR -->
    <section class="h-full">
        <!-- Eszközök hero section -->
        <section class="mx-auto max-w-[2000px] min-w-[280px] py-8 px-4 h-full sm:px-8 md:px-10 lg:0px-20" ng-show="mode === 'eszkozok'">

            <div class="w-full mb-2 mt-2 rounded-[50px] bg-[#EBF4DD] py-6 flex flex-col items-center px-2
            sm:rounded-[60px] sm:py-9 sm:px-4
            md:rounded-[70px] md:py-11 md:px-8
            lg:rounded-[80px] lg:flex-row lg:py-14      
            xl:px-16">

                <img class="w-full max-w-[280px] rounded-[50px] ml-0 sm:max-w-[320px] md:max-w-[360px] lg:max-w-[400px] lg:ml-6 lg:order-2 xl:max-w-[410px]"
                    src="../../assets/kepek/KonyhaiEszközök.jpg" alt="Konyhai eszközök kép" title="Konyhai eszközök kép">

                <div class="text-center md:text-left">

                    <h1 class="text-xl leading-[30px] font-bold mb-6 mt-6 md:text-4xl md:leading-[40px]  lg:text-5xl lg:leading-[50px]">
                        Fedezd fel a konyhai eszközök világát!
                    </h1>

                    <p class="text-md leading-[27px] font-normal mb-8 md:mb-12 sm:text-[24px]">
                        Praktikus, innovatív és stílusos megoldások minden háztartásba – nézd meg, melyik eszköz lehet a te konyhád legjobb segítője.
                    </p>

                    <button class="w-full max-w-[350px] text-xl font-bold rounded-[38px] bg-[#5A7863] text-white py-4 px-6 sm:px-9">
                        <a href="#konyhaiEszkozok" class="flex items-center justify-between w-full">
                            <span>Kezdjünk hozzá!</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" height="20px" width="20px" viewBox="0 0 330 330">
                                <path d="M15,180h263.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C232.322,253.535,236.161,255,240,255 s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0 c-5.858,5.857-5.858,15.355,0,21.213L278.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z" />
                            </svg>
                        </a>
                    </button>

                </div>
            </div>
        </section>

        <!--Átváltó hero section -->
        <section class="mx-auto max-w-[2000px] min-w-[280px] py-8 px-4 h-full sm:px-8 md:px-10 lg:0px-20" ng-show="mode === 'atvalto'">

            <div class="w-full mb-2 mt-2 rounded-[50px] bg-[#EBF4DD] py-6 flex flex-col items-center px-2
            sm:rounded-[60px] sm:py-9 sm:px-4
            md:rounded-[70px] md:py-11 md:px-8
            lg:rounded-[80px] lg:flex-row lg:py-14      
            xl:px-16">

                <img class="w-full max-w-[280px] rounded-[50px] ml-0 
            sm:max-w-[320px] 
            md:max-w-[360px] 
            lg:max-w-[400px] lg:ml-6 lg:order-2
            xl:max-w-[410px]"
                    src="../../assets/kepek/atvaltoHero.jpg" alt="Konyhai mértékegység átváltó eszközök" title="Konyhai mértékegység átváltó eszközök">

                <div class="text-center md:text-left">

                    <h1 class="text-xl leading-[30px] font-bold mt-6 mb-6 md:text-4xl md:leading-[40px] md:mb-6 lg:text-5xl lg:leading-[50px]">
                        Kérj segítséget az átváltásban!
                    </h1>

                    <p class="text-md leading-[27px] font-normal mb-8 md:mb-12 sm:text-[24px]">
                        A receptekben gyakran gondot okoz a különböző mértékegységek átváltása, főleg ha csészével, kanalakkal vagy eltérő mértékekkel dolgozunk.
                        Ezzel az átváltóval azonban ez többé nem probléma: gyorsan és egyszerűen kiszámolod a pontos mennyiségeket, így nyugodtan a főzésre koncentrálhatsz.
                    </p>

                    <button class="w-full max-w-[350px] text-xl font-bold rounded-[38px] bg-[#5A7863] text-white py-4 px-6 sm:px-9">
                        <a href="#atvalto" class="flex items-center justify-between w-full">
                            <span>Kezdjünk hozzá!</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" height="20px" width="20px" viewBox="0 0 330 330">
                                <path d="M15,180h263.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C232.322,253.535,236.161,255,240,255 s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0 c-5.858,5.857-5.858,15.355,0,21.213L278.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z" />
                            </svg>
                        </a>
                    </button>

                </div>
            </div>
        </section>

        <!-- Mini navbar -->
        <section class=" flex justify-center items-center flex-wrap bg-[#5A7863] h-1/2 p-2">

            <div class="flex text-center border max-w-2xl p-6 rounded-[50px] min-w-[270px] m-2 text-white hover:bg-[#EBF4DD] hover:text-black" ng-click="mode = 'eszkozok'">
                <div class="w-sreen max-w-screen-xl px-10 mx-auto">
                    <ul class="flex-col md:flex-row flex md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <button class="md:hover:bg-transparent md:border-0 block hover:text-black md:p-0 text-lg">
                                Konyhai eszközök
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex text-center border max-w-2xl p-6 rounded-[50px] min-w-[270px] text-white hover:bg-[#EBF4DD] hover:text-black" ng-click="mode = 'atvalto'">
                <div class="w-sreen max-w-screen-xl px-10 mx-auto">
                    <ul class="flex-col md:flex-row flex md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <button class=" md:hover:bg-transparent md:border-0 block hover:text-black md:p-0 text-lg">
                                Átváltó
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

        </section>

    </section>

    <!-- TARTALOM RÉSZ -->
    <!-- Konyhai eszköz rész -->
    <section ng-show="mode === 'eszkozok'"
        id="konyhaiEszkozok"
        class="min-w-[280px] py-8 px-4 sm:px-8 md:px-10 lg:px-20 bg-[#EBF4DD]">

        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- Kártya -->
                <div class="flex flex-col md:flex-row bg-white rounded-[20px] shadow-md overflow-hidden transition duration-300 hover:shadow-xl"
                    ng-repeat="e in getPaginatedData()">

                    <!-- Kép -->
                    <div class="w-full md:w-1/2 aspect-[4/3]">
                        <img ng-src="../../assets/kepek/konyhaiEszkoz/{{ e.Kep }}"
                            alt="{{e.Nev}}"
                            title="{{e.Nev}}"
                            class="w-full h-full object-cover" />
                    </div>

                    <!-- Szöveg -->
                    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center space-y-4">

                        <p class="border rounded-[50px] border-black w-fit px-3 py-1 text-sm">
                            {{ e.Besorolas_nev }}
                        </p>

                        <h1 class="text-2xl sm:text-3xl font-bold">
                            {{ e.Nev }}
                        </h1>

                        <p class="text-justify text-sm sm:text-base leading-relaxed">
                            {{ e.Leiras }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div class="flex justify-center align-center w-full mt-8">
            <ul class="flex justify-center text-gray-600 gap-4 font-medium p-4 rounded-[50px] bg-[#9ab8ab]">

                <!-- Előző 
                    <li>
                        <a href=""
                            ng-click="setPage(currentPage - 1)"
                            ng-if="currentPage > 1"
                            class="rounded-full px-4 py-2 hover:bg-white cursor-pointer">
                            ◀
                        </a>
                    </li>-->

                <!-- Oldalszámok -->
                <li ng-repeat="page in getPageRange() track by page">
                    <a href=""
                        ng-click="setPage(page)"
                        ng-class="{'bg-white text-gray-600': currentPage === page, 'hover:bg-white transition duration-300 ease-in-out': currentPage !== page}"
                        class="rounded-full px-4 py-2 cursor-pointer">
                        {{page}}
                    </a>
                </li>

                <!-- Következő
                    <li>
                        <a href=""
                            ng-click="setPage(currentPage + 1)"
                            ng-if="currentPage < totalPages()"
                            class="rounded-full px-4 py-2 hover:bg-white cursor-pointer">
                            ▶
                        </a>
                    </li> -->

            </ul>
        </div>
        </div>
</section>

<!-- Mértékegység átváltó -->
<section ng-show="mode === 'atvalto'" class="mx-auto max-w-[2000px] min-w-[280px] h-full" id="atvalto">

    <!-- Átváltók -->
    <section class="w-full py-4 px-2 bg-[#EBF4DD] flex flex-col items-center sm:py-9 sm:px-4 md:py-11 md:px-8 lg:py-14 xl:px-16">

        <div class="w-full max-w-6xl flex flex-col gap-8">

            <!-- Cím -->
            <div class="w-full flex justify-center border-b-[5px] border-[#5A7863] pb-4">
                <p class="text-3xl sm:text-4xl md:text-5xl font-bold text-center">
                    Átváltók
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-6">

                <!--   TÖMEG   -->
                <div class="w-full sm:w-[480px] bg-white rounded-2xl shadow-md p-6">
                    <p class="border rounded-full border-black w-fit px-3 py-1 mb-4">Tömeg</p>

                    <form class="space-y-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="tomeg1" placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3 focus:ring-sky-600" />
                                <label for="tomeg1"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500
                                peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-base
                                peer-focus:-top-2 peer-focus:text-xs transition-all">
                                    Mennyiség
                                </label>
                            </div>
                            <select id="tomegHonnan" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="gramm">g</option>
                                <option value="dkg">dkg</option>
                                <option value="kg">kg</option>
                                <option value="oz">oz</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="tomeg2" readonly placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="tomeg2"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500">
                                    Eredmény
                                </label>
                            </div>
                            <select id="tomegHova" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="gramm">g</option>
                                <option value="dkg">dkg</option>
                                <option value="kg">kg</option>
                                <option value="oz">oz</option>
                            </select>
                        </div>

                        <button type="button" onclick="tomegValtas()"
                            class="w-full bg-[#5A7863] hover:bg-[#759277] text-white py-2 rounded-lg">
                            Átváltás
                        </button>
                    </form>
                </div>

                <!--   TÉRFOGAT   -->
                <div class="w-full sm:w-[480px] bg-white rounded-2xl shadow-md p-6">
                    <p class="border rounded-full border-black w-fit px-3 py-1 mb-4">Térfogat</p>

                    <form class="space-y-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="terfogat1" placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="terfogat1"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500
                                peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-base
                                peer-focus:-top-2 peer-focus:text-xs transition-all">
                                    Mennyiség
                                </label>
                            </div>
                            <select id="terfogatHonnan" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="ml">ml</option>
                                <option value="dl">dl</option>
                                <option value="l">l</option>
                                <option value="tsp">tsp</option>
                                <option value="tbsp">tbsp</option>
                                <option value="cup">cup</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="terfogat2" readonly placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="terfogat2"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500">
                                    Eredmény
                                </label>
                            </div>
                            <select id="terfogatHova" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="ml">ml</option>
                                <option value="dl">dl</option>
                                <option value="l">l</option>
                                <option value="tsp">tsp</option>
                                <option value="tbsp">tbsp</option>
                                <option value="cup">cup</option>
                            </select>
                        </div>

                        <button type="button" onclick="terfogatValtas()"
                            class="w-full bg-[#5A7863] hover:bg-[#759277] text-white py-2 rounded-lg">
                            Átváltás
                        </button>
                    </form>
                </div>

                <!--   HŐMÉRSÉKLET   -->
                <div class="w-full sm:w-[480px] bg-white rounded-2xl shadow-md p-6">
                    <p class="border rounded-full border-black w-fit px-3 py-1 mb-4">Hőmérséklet</p>

                    <form class="space-y-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="homerseklet1" placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="homerseklet1"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500
                                peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-base
                                peer-focus:-top-2 peer-focus:text-xs transition-all">
                                    Mennyiség
                                </label>
                            </div>
                            <select id="homersekletHonnan" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="C">°C</option>
                                <option value="F">°F</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="homerseklet2" readonly placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="homerseklet2"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500">
                                    Eredmény
                                </label>
                            </div>
                            <select id="homersekletHova" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="C">°C</option>
                                <option value="F">°F</option>
                            </select>
                        </div>

                        <button type="button" onclick="homersekletValtas()"
                            class="w-full bg-[#5A7863] hover:bg-[#759277] text-white py-2 rounded-lg">
                            Átváltás
                        </button>
                    </form>
                </div>

                <!--   IDŐ   -->
                <div class="w-full sm:w-[480px] bg-white rounded-2xl shadow-md p-6">
                    <p class="border rounded-full border-black w-fit px-3 py-1 mb-4">Idő</p>

                    <form class="space-y-4">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="ido1" placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="ido1"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500
                                peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-base
                                peer-focus:-top-2 peer-focus:text-xs transition-all">
                                    Mennyiség
                                </label>
                            </div>
                            <select id="idoHonnan" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="ora">óra</option>
                                <option value="perc">perc</option>
                            </select>
                        </div>

                        <div class="flex gap-2 items-center">
                            <div class="relative w-full sm:w-56 md:w-64">
                                <input type="number" step="any" id="ido2" readonly placeholder=" "
                                    class="peer w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-500 px-3" />
                                <label for="ido2"
                                    class="absolute left-3 -top-2 text-xs bg-white px-1 text-gray-500">
                                    Eredmény
                                </label>
                            </div>
                            <select id="idoHova" class="w-32 h-10 rounded-lg ring-2 ring-gray-500 px-2">
                                <option value="ora">óra</option>
                                <option value="perc">perc</option>
                            </select>
                        </div>

                        <button type="button" onclick="idoValtas()"
                            class="w-full bg-[#5A7863] hover:bg-[#759277] text-white py-2 rounded-lg">
                            Átváltás
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

</section>

</section>

</section>

<?php include "../footer.php"; ?>
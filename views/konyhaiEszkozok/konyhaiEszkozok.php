<?php include "../head.php"; ?>

<!-- Content rész  -->
<section ng-controller="controller" ng-cloak>

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

            <div class="flex text-center border max-w-2xl p-6 rounded-[50px] min-w-[270px] m-2 text-white hover:bg-[#EBF4DD] hover:text-black" ng-click="mode = 'eszkozok'"> <!-- 1 -->
                <div class="w-sreen max-w-screen-xl px-10 mx-auto"><!-- 2 -->
                    <ul class="flex-col md:flex-row flex md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <button class="md:hover:bg-transparent md:border-0 block hover:text-black md:p-0 text-lg">
                                Konyhai eszközök
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex text-center border max-w-2xl p-6 rounded-[50px] min-w-[270px] text-white hover:bg-[#EBF4DD] hover:text-black" ng-click="mode = 'atvalto'"> <!-- 1 -->
                <div class="w-sreen max-w-screen-xl px-10 mx-auto"><!-- 2 -->
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

    <!-- Rész, amiben minden konyhai eszköz tárolódik -->
    <section ng-show="mode === 'eszkozok'"
        id="konyhaiEszkozok"
        class="max-w-full min-w-[280px] py-8 px-4 sm:px-8 md:px-10 lg:px-20 bg-[#EBF4DD]">

        <div class="flex flex-wrap justify-center gap-6">

            <!-- Kártya  -->
            <div class="flex flex-col lg:flex-row max-w-xl w-full bg-white rounded-[20px] shadow-md overflow-hidden" ng-repeat="e in eszkozok">

                <!-- Kép a konyhai eszközről -->
                <div class="w-full lg:w-2/5 ">
                    <img ng-src="{{e.Kep}}" alt="{{e.Nev}}" title="{{e.Nev}}" class="w-full h-full object-cover " />
                </div>

                <!-- Leírás a konyhai eszközről -->
                <div class="w-full lg:w-3/5 p-6 flex flex-col justify-center space-y-4">
                    <p class="border rounded-[50px] border-black w-fit px-2 py-1 text-sm">{{ e.Besorolas_nev }}</p>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">{{ e.Nev }}</h1>
                    <p class="text-justify text-sm sm:text-base">{{ e.Leiras }}</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Átváltó -->
    <section ng-show="mode === 'atvalto'" class="mx-auto max-w-[2000px] min-w-[280px] h-full " id="atvalto">
        
        <section class="w-full py-6 px-2 bg-[#EBF4DD] flex flex-col items-center 
                sm:py-9 sm:px-4
                md:py-11 md:px-8
                lg:py-14      
                xl:px-16">

            <div class="w-full flex align-center justify-start flex-wrap gap-6">

                <div class="w-full flex align-center justify-center border-l-[#5A7863] border-b-[5px] border-b-[#5A7863] border-solid px-10 rounded-[0_0_10px_10px]
                sm:rounded-[0_0_10px_10px] sm:w-full">
                    <p class="text-5xl leading-[90px] font-bold text-center">Tömeg</p>
                </div>

                <!-- Kártya  -->
                <div class="flex flex-col lg:flex-row max-w-xl w-fit bg-white rounded-[20px] shadow-md overflow-hidden">

                    <!-- Átváltó 1 -->
                    <div class="w-full lg:w-fit p-6 flex flex-col justify-center space-y-4">
                        <p class="border rounded-[50px] border-black w-fit px-2 py-1 text-sm">Dl -> Cl</p>

                        <div class="bg-white p-4 rounded-lg">
                            <div class="relative bg-inherit">
                                <input type="text" id="deciliter" name="deciliter" class="peer bg-transparent h-10 w-72 rounded-lg text-gray-200 placeholder-transparent ring-2 px-2 ring-gray-500 focus:ring-sky-600 focus:outline-none focus:border-rose-600" placeholder="Deciliter(dl)" />
                                <label for="username" class="absolute cursor-text left-0 -top-3 text-sm text-gray-500 bg-inherit mx-1 px-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sky-600 peer-focus:text-sm transition-all">
                                    Deciliter(dl)
                                </label>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg">
                            <div class="relative bg-inherit">
                                <input type="text" id="centiliter" name="centiliter" class="peer bg-transparent h-10 w-72 rounded-lg text-gray-200 placeholder-transparent ring-2 px-2 ring-gray-500 focus:ring-sky-600 focus:outline-none focus:border-rose-600" placeholder="Centiliter(cl)" />
                                <label for="username" class="absolute cursor-text left-0 -top-3 text-sm text-gray-500 bg-inherit mx-1 px-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sky-600 peer-focus:text-sm transition-all">
                                    Centiliter(cl)
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Kártya  -->
                <div class="flex flex-col lg:flex-row max-w-xl w-fit bg-white rounded-[20px] shadow-md overflow-hidden">

                    <!-- Átváltó 2 -->
                    <div class="w-full lg:w-fit p-6 flex flex-col justify-center space-y-4">
                        <p class="border rounded-[50px] border-black w-fit px-2 py-1 text-sm">Dl -> Cl</p>

                        <div class="bg-white p-4 rounded-lg">
                            <div class="relative bg-inherit">
                                <input type="text" id="username" name="username" class="peer bg-transparent h-10 w-72 rounded-lg text-gray-200 placeholder-transparent ring-2 px-2 ring-gray-500 focus:ring-sky-600 focus:outline-none focus:border-rose-600" placeholder="Deciliter(dl)" />
                                <label for="username" class="absolute cursor-text left-0 -top-3 text-sm text-gray-500 bg-inherit mx-1 px-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sky-600 peer-focus:text-sm transition-all">
                                    Deciliter(dl)
                                </label>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg">
                            <div class="relative bg-inherit">
                                <input type="text" id="username" name="username" class="peer bg-transparent h-10 w-72 rounded-lg text-gray-200 placeholder-transparent ring-2 px-2 ring-gray-500 focus:ring-sky-600 focus:outline-none focus:border-rose-600" placeholder="Centiliter(cl)" />
                                <label for="username" class="absolute cursor-text left-0 -top-3 text-sm text-gray-500 bg-inherit mx-1 px-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sky-600 peer-focus:text-sm transition-all">
                                    Centiliter(cl)
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>


    </section>
</section>

<?php include "../footer.php"; ?>
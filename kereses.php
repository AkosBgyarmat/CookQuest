<?php include __DIR__ . '/views/head.php'; ?>

<main class="flex-grow w-full bg-[#90ab8b]">

    <div class="max-w-6xl mx-auto px-4 py-10" ng-controller="keresesCtrl">

        <!-- Cím -->
        <div class="border-b border-gray-300 text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-5 text-white">
                Találatok a "{{ q }}" keresésre
            </h1>
            <span class="text-white">Találatok száma: {{receptek.legth + eszkozok.length}}</span>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">Receptek</h2>

            <!-- RECEPTEK -->
            <div ng-repeat="item in receptek" class="flex items-center gap-4 p-3 hover:bg-gray-100 rounded-lg">


                <img ng-src="/CookQuest/assets/kepek/{{ item.tipus === 'recept' ? 'etelek' : 'konyhaiEszkoz' }}/{{item.kep}}"
                    class="w-12 h-12 object-cover rounded-lg">

                <div>
                    <a class="underline" ng-href="views/receptek/receptek.php?id={{item.id}}&q={{q}}">
                        {{ item.nev }}
                    </a>
                    <p class="text-sm text-gray-500">
                        {{ item.tipus === 'recept' ? 'Recept' : 'Eszköz' }}
                    </p>
                </div>

            </div>

            <h2 class="text-2xl font-bold mb-4">Eszközök</h2>

            <!-- ESZKÖZÖK -->
            <div ng-repeat="item in eszkozok"
                class="flex items-center gap-4 p-3 hover:bg-gray-100 rounded-lg transition">

                <!-- KÉP -->
                <img
                    ng-src="/CookQuest/assets/kepek/{{ item.tipus === 'felszereles' ? 'konyhaiEszkoz' : 'etelek'  }}/{{ item.kep }}"
                    onerror="this.src='/CookQuest/assets/kepek/Logo.png'"
                    class="w-12 h-12 object-cover rounded-lg shadow-sm">

                <!-- SZÖVEG -->
                <div>
                    <a class="underline" ng-href="views/konyhaiEszkozok/konyhaiEszkozok.php?id={{item.id}}&q={{q}}">
                        {{ item.nev }}
                    </a>
                    <p class="text-sm text-gray-500">
                        {{ item.tipus === 'recept' ? 'Recept' : 'Eszköz' }}
                    </p>
                </div>

            </div>

            <div ng-if="receptek.length === 0 && eszkozok.length === 0"
                class="text-center text-white text-xl mt-10">
                Nincs találat 😢
            </div>

        </div>



    </div>
</main>
<?php include __DIR__ . '/views/footer.php'; ?>
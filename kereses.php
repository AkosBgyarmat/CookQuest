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

        <!-- RECEPTEK -->
        <div ng-if="receptek.length > 0" class="bg-white p-8 rounded-2xl shadow-md mb-10">
            <h2 class="text-2xl font-bold mb-4">Receptek</h2>
            <ul class="bg-white p-6 leading-7">
                <li ng-repeat="item in receptek">
                    <a class="underline" ng-href="views/receptek/receptek.php?id={{item.id}}&q={{q}}">
                        {{ item.nev }}
                    </a>
                </li>
            </ul>
        </div>

        <!-- ESZKÖZÖK -->
        <div ng-if="eszkozok.length > 0" class="bg-white p-8 rounded-2xl shadow-md">

            <h2 class="text-2xl font-bold mb-4">Eszközök</h2>

            <ul class="bg-white p-6 leading-7">
                <li ng-repeat="item in eszkozok">
                    <a class="underline" ng-href="views/konyhaiEszkozok/konyhaiEszkozok.php?id={{item.id}}&q={{q}}">
                        {{ item.nev }} 
                    </a>
                </li>
            </ul>

        </div>

        <div ng-if="receptek.length === 0 && eszkozok.length === 0"
            class="text-center text-white text-xl mt-10">
            Nincs találat 😢
        </div>

    </div>
</main>
<?php include __DIR__ . '/views/footer.php'; ?>
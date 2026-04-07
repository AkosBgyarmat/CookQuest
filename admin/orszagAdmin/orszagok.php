<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="orszagController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Országok - {{orszagok.length}}</h1>
    </header>

    <button ng-click="createOrszag()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új ország
    </button>

    <div class="hidden md:block overflow-x-auto rounded-xl">
        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="o in orszagok track by o.Id">
                    <td class="p-3">{{o.Id}}</td>
                    <td class="p-3">{{o.Nev}}</td>
                    <td class="p-3">{{o.Torolve == 0 ? 'Nem' : 'Igen'}}</td>

                    <td class="p-3 ">

                        <button ng-click="editOrszag(o)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="o.Torolve == 0"
                            ng-click="deleteOrszag(o.Id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="o.Torolve == 1"
                            ng-click="visszaallitas(o.Id)"
                            class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                            Visszaállítás
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="md:hidden space-y-3">

        <div class="bg-white m-2 p-4 rounded-lg shadow flex justify-between items-center"
            ng-repeat="o in orszagok track by o.Id">

            <div>

                <p class="text-sm text-gray-500">
                    ID: {{o.Id}}
                </p>

                <p class="font-semibold text-lg">
                    {{o.Nev}}
                </p>

            </div>

            <div class="flex gap-2">

                <a href="orszag_szerkeszt.php?id={{o.Id}}"
                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Szerkeszt
                </a>

                <a href="orszag_torol.php?id={{o.Id}}"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                    Törlés
                </a>

            </div>

        </div>

    </div>
    <?php include "orszagSzerkesztModal.php"; ?>
    <?php include "../layout/feedbackModal.php"; ?>
</main>

<?php include "../layout/footer.php"; ?>

</div>
</div>
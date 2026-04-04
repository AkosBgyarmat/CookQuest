<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 p-4 md:p-6" ng-controller="eszkozController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Eszközök - {{eszkoz.length}}</h1>
    </header>

    <button ng-click="createEszkoz()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új eszköz
    </button>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Besorolás</th>
                    <th class="p-3 text-left">Leírás</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="e in eszkoz">
                    <td class="p-3">{{e.id}}</td>
                    <td class="p-3">{{e.Nev}}</td>
                    <td class="p-3">{{e.Besorolas_nev}}</td>
                    <td class="p-3">
                        {{e.Leiras | limitTo: 50}}
                        <span ng-if="e.Leiras.length > 50">...</span>
                    </td>
                    <td class="p-3">{{e.Torolve == 0 ? 'Nem' : 'Igen'}}</td>

                    <td class="p-3 space-x-2 width-full">

                        <button ng-click="editEszkoz(e)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded m-2">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="e.Torolve == 0"
                            ng-click="torles(e.id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="e.Torolve == 1"
                            ng-click="visszaallitas(e.id)"
                            class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                            Visszaállítás
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="md:hidden space-y-4">

        <div class="bg-white m-2 rounded-lg shadow p-4"
            ng-repeat="e in eszkoz">

            <p class="text-lg font-semibold">
                {{e.Nev}}
            </p>

            <p class="text-sm text-gray-500">
                ID: {{e.id}}
            </p>

            <p class="text-sm">
                Besorolás: {{e.Besorolas_nev}}
            </p>

            <p class="text-sm text-gray-600">
                Törölve: {{e.Torolve == 0 ? 'Nem' : 'Igen'}}
            </p>

            <div class="flex gap-2 mt-3">

                <button ng-click="editEszkoz(e)"
                    class="bg-[#C0CEB8] text-black px-3 py-1 rounded text-sm">
                    Szerkeszt
                </button>

                <button
                    ng-if="e.Torolve == 0"
                    ng-click="torles(e.id)"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                    Törlés
                </button>

                <button ng-if="e.Torolve == 1"
                    ng-click="visszaallitas(e.id)"
                    class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 transition">
                    Visszaállítás
                </button>

            </div>



        </div>

    </div>

    <?php include "../layout/feedbackModal.php"; ?>
    <?php include "eszkozSzerkesztModal.php"; ?>

</main>

<?php include "../layout/footer.php"; ?>

</div>
</div>
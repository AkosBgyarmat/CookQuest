<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="hozzavaloController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Hozzávalók - {{hozzavalo.length}}</h1>
    </header>

    <button ng-click="createHozzavalo()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új hozzavalo
    </button>

    <!-- Asztali nézet -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Elnevezés</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Műveletek</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="h in hozzavalo track by h.id">
                    <td class="p-2">{{h.id}}</td>
                    <td class="p-3">{{h.Elnevezes}}</td>
                    <td class="p-3">{{h.Torolve == 0 ? 'Nem' : 'Igen'}}</td>
                    <td class="p-3">

                        <button ng-click="editHozzavalo(h)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="h.Torolve == 0"
                            ng-click="torles(h.id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="h.Torolve == 1"
                            ng-click="visszaallitas(h.id)"
                            class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                            Visszaállítás
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <!-- Mobil nézet -->
    <div class="md:hidden space-y-4">

        <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
            ng-repeat="h in hozzavalo track by h.id">

            <div>
                <p class="text-sm text-gray-500">
                    ID: {{h.id}}
                </p>

                <p class="text-lg font-semibold">
                    {{h.Elnevezes}}
                </p>
                
                <p class="text-sm text-gray-500">
                    Törölve: {{h.Torolve == 0 ? 'Nem' : 'Igen'}}
                </p>
            </div>

            <div class="flex gap-2 mt-3">

                <button ng-click="editHozzavalo(h)"
                    class="bg-[#C0CEB8] text-black mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Szerkeszt
                </button>

                <button
                    ng-if="h.Torolve == 0"
                    ng-click="torles(h.id)"
                    class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Törlés
                </button>

                <button ng-if="h.Torolve == 1"
                    ng-click="visszaallitas(h.id)"
                    class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Visszaállítás
                </button>

            </div>

        </div>

    </div>


    <?php include "hozzavaloSzerkesztModal.php"; ?>
    <?php include "visszajelzoModal.php"; ?>

</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>
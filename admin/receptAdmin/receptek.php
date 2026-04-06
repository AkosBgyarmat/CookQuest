<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 p-4 md:p-6" ng-controller="receptController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Receptek - {{recept.length}}</h1>
    </header>

    <button ng-click="createRecept()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új recept
    </button>

    <!-- Asztali nézet -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Elkészítési leírás</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="r in recept track by r.id">
                    <td class="p-3">{{r.id}}</td>
                    <td class="p-3">{{r.Nev}}</td>
                    <td class="p-3">
                        {{r.Elkeszitesi_leiras | limitTo: 50}}
                        <span ng-if="r.Elkeszitesi_leiras.length > 50">...</span>
                    </td>
                    <td class="p-3">{{r.Torolve == 0 ? 'Nem' : 'Igen'}}</td>

                    <td class="p-3 ">

                        <button ng-click="editRecept(r)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="r.Torolve == 0"
                            ng-click="torles(r.id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="r.Torolve == 1"
                            ng-click="visszaallitas(r.id)"
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
            ng-repeat="r in recept track by r.id">

            <div>
                <p class="text-lg font-semibold">
                    {{r.Nev}}
                </p>

                <p class="text-sm text-gray-500">
                    ID: {{r.id}}
                </p>
            </div>


            <div class="flex gap-2 mt-3">

                <button ng-click="editRecept(r)"
                    class="bg-[#C0CEB8] text-black mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Szerkeszt
                </button>

                <button
                    ng-if="r.Torolve == 0"
                    ng-click="torles(r.id)"
                    class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Törlés
                </button>

                <button ng-if="r.Torolve == 1"
                    ng-click="visszaallitas(r.id)"
                    class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Visszaállítás
                </button>

            </div>

        </div>

    </div>

    <?php include "receptSzerkesztModal.php"; ?>
    <?php include "../layout/feedbackModal.php"; ?>
</main>


<?php include "../layout/footer.php"; ?>

</div>
</div>
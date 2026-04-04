<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 p-4 md:p-6" ng-controller="receptKategoriaController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Recept kategóriák - {{receptKategoria.length}}</h1>
    </header>

    <button ng-click="createReceptKategoria()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új recept kategória
    </button>

    <!-- Recept kategóriák asztali nézet -->
    <div class="hidden md:block overflow-x-auto">

        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Kategória</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Műveletek</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="k in receptKategoria track by k.id">
                    <td class="p-3">{{k.id}}</td>
                    <td class="p-3">{{k.Kategoria}}</td>
                    <td class="p-3">{{k.Torolve == 0 ? 'Nem' : 'Igen'}}</td>
                    <td class="p-3">

                        <button ng-click="editReceptKategoria(k)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="k.Torolve == 0"
                            ng-click="torles(k.id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="k.Torolve == 1"
                            ng-click="visszaallitas(k.id)"
                            class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                            Visszaállítás
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <!-- Recept kategóriák mobil nézet -->
    <div class="md:hidden space-y-3">

        <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
            ng-repeat="k in receptKategoria track by k.id">

            <div>

                <p class="text-sm text-gray-500">
                    ID: {{k.id}}
                </p>

                <p class="text-lg font-semibold">
                    {{k.Kategoria}}
                </p>

            </div>

            <div class="flex gap-2">

                <button ng-click="editReceptKategoria(k)"
                    class="bg-[#C0CEB8] text-black px-3 py-1 rounded text-sm">
                    Szerkeszt
                </button>

                <button
                    ng-if="k.Torolve == 0"
                    ng-click="torles(k.id)"
                    class="bg-red-500 text-white mb-5 px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                    Törlés
                </button>

                <button ng-if="k.Torolve == 1"
                    ng-click="visszaallitas(k.id)"
                    class="bg-green-500 text-white mb-5 px-3 py-1 rounded text-sm hover:bg-green-600 transition">
                    Visszaállítás
                </button>

            </div>

        </div>

    </div>

    <?php include "receptKatSzerkModal.php"; ?>
    <?php include "../layout/feedbackModal.php"; ?>
</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>
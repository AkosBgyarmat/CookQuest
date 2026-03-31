<?php include "../../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 p-4 md:p-6" ng-controller="eszkozKategoriaController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Eszköz kategóriák - {{eszkozKategoria.length}}</h1>
    </header>

    <!-- Eszköz kategóriák -->
    <div>

        <button ng-click="createEszkozKategoria()"
            class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
            + Új eszköz kategória
        </button>

        <!-- Eszköz kategóriák asztali nézet -->
        <div class="hidden md:block overflow-x-auto">

            <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Elnevezés</th>
                        <th class="p-3 text-left">Műveletek</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-t" ng-repeat="b in eszkozKategoria track by b.id">
                        <td class="p-3">{{b.id}}</td>
                        <td class="p-3">{{b.ELnevezes}}</td>

                        <td class="p-3 space-x-2 width-full">
                            <button ng-click="editEszkozKategoria(b)"
                                class="bg-[#C0CEB8] text-black px-3 py-1 rounded m-2">
                                Szerkeszt
                            </button>

                            <button
                                ng-if="b.Torolve == 0"
                                ng-click="torles(b.id)"
                                class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                                Törlés
                            </button>

                            <button ng-if="b.Torolve == 1"
                                ng-click="visszaallitas(b.id)"
                                class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                                Visszaállítás
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Eszköz kategóriák mobil nézet -->
        <div class="md:hidden space-y-3">

            <div class="bg-white m-2 rounded-lg shadow p-4"
                ng-repeat="b in eszkozKategoria track by b.id">

                <div>

                    <p class="text-sm text-gray-500">
                        ID: {{b.id}}
                    </p>

                    <p class="font-semibold">
                        {{b.ELnevezes}}
                    </p>

                </div>

                <div class="flex gap-2 mt-3">

                <button ng-click="editEszkozKategoria(b)"
                    class="bg-[#C0CEB8] text-black px-3 py-1 rounded text-sm">
                    Szerkeszt
                </button>

                <button
                    ng-if="b.Torolve == 0"
                    ng-click="torles(b.id)"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                    Törlés
                </button>

                <button ng-if="b.Torolve == 1"
                    ng-click="visszaallitas(b.id)"
                    class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 transition">
                    Visszaállítás
                </button>

                </div>

            </div>

        </div>

    </div>

    <?php include "visszajelzoModal.php"; ?>
    <?php include "eszkozKatSzerkModal.php"; ?>
</main>

<?php include "../../layout/footer.php"; ?>
</div>
</div>
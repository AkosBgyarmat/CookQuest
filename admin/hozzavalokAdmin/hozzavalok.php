<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="hozzavaloController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Hozzávalók - {{hozzavalo.length}}</h1>
    </header>

    <a href="orszagokUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block m-2">
        + Új hozzávaló
    </a>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow rounded">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Elnevezes</th>
                    <th class="p-3 text-left">Műveletek</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="h in hozzavalo track by h.id">
                    <td class="p-2">{{h.id}}</td>
                    <td class="p-3">{{h.Elnevezes}}</td>
                    <td class="p-3">

                        <a href="hozzavalok_szerkeszt.php?id=1"
                            class="bg-blue-500 text-white mb-5 mr-2 px-2 py-1 rounded">
                            Szerkeszt
                        </a>

                        <a href="hozzavalok_torol.php?id=1"
                            class="bg-red-500 text-white mb-5 px-2 py-1 rounded">
                            Törlés
                        </a>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="md:hidden space-y-3">

        <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
            ng-repeat="h in hozzavalo track by h.id">

            <div>

                <p class="text-sm text-gray-500">
                    ID: {{h.id}}
                </p>

                <p class="text-lg font-semibold">
                    {{h.Elnevezes}}
                </p>

            </div>

            <div class="flex gap-2">

                <a href="hozzavalok_szerkeszt.php?id={{h.id}}"
                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Szerkeszt
                </a>

                <a href="hozzavalok_torol.php?id={{h.id}}"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                    Törlés
                </a>

            </div>

        </div>

    </div>

</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>
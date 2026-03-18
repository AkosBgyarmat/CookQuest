<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="orszagController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Országok - {{orszagok.length}}</h1>
    </header>

    <a href="orszagokUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block m-2">
        + Új ország
    </a>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow rounded">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="o in orszagok track by o.Id">
                    <td class="p-3">{{o.Id}}</td>
                    <td class="p-3">{{o.Nev}}</td>

                    <td class="p-3 ">

                        <a href="receptek_szerkeszt.php?id=1"
                            class="bg-blue-500 text-white mb-5 px-3 py-1 rounded">
                            Szerkeszt
                        </a>

                        <a href="receptek_torol.php?id=1"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded">
                            Törlés
                        </a>

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
</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>
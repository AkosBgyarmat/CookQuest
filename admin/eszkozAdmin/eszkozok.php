<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="eszkozController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Eszközök - {{eszkozok.length}}</h1>
    </header>

    <a href="eszkozokUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block m-2">
        + Új eszköz
    </a>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow rounded">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Besorolás</th>
                    <th class="p-3 text-left">Leírás</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="e in eszkozok">
                    <td class="p-3">{{e.id}}</td>
                    <td class="p-3">{{e.Nev}}</td>
                    <td class="p-3">{{e.Besorolas_nev}}</td>
                    <td class="p-3">
                        {{e.Leiras | limitTo: 80}}
                        <span ng-if="e.Leiras.length > 80">...</span>
                    </td>

                    <td class="p-3 space-x-2 width-full">

                        <a href="receptek_szerkeszt.php?id=1"
                            class="bg-blue-500 text-white px-2 py-1 rounded">
                            Szerkeszt
                        </a>

                        <a href="receptek_torol.php?id=1"
                            class="bg-red-500 text-white px-2 py-1  rounded">
                            Törlés
                        </a>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="md:hidden space-y-4">

        <div class="bg-white m-2 rounded-lg shadow p-4"
            ng-repeat="e in eszkozok">

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
                {{e.Leiras | limitTo:80}}<span ng-if="e.Leiras.length > 80">...</span>
            </p>

            <div class="flex gap-2 mt-3">

                <a href="eszkozok_szerkeszt.php?id={{e.id}}"
                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Szerkeszt
                </a>

                <a href="eszkozok_torol.php?id={{e.id}}"
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
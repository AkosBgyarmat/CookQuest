<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="receptController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Receptek - {{recept.length}}</h1>
    </header>

    <a href="receptekUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block m-2">
        + Új recept
    </a>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow rounded">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Név</th>
                    <th class="p-3 text-left">Elkészítési idő</th>
                    <th class="p-3 text-left">Nehézség</th>
                    <th class="p-3 text-left">Begyűjthető pontok</th>
                    <th class="p-3 text-left">Adag</th>
                    <th class="p-3 text-left">Elkészítési leírás</th>
                    <th class="p-3 text-left">Elkészítési mód</th>
                    <th class="p-3 text-left">Arkategoria</th>
                    <th class="p-3 text-left">Alkategória</th>
                    <th class="p-3 text-left">Kalória</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="r in recept track by r.id">
                    <td class="p-3">{{r.id}}</td>
                    <td class="p-3">{{r.Nev}}</td>
                    <td class="p-3">{{(r.ElkeszitesiIdo.split(':')[0]*60 + r.ElkeszitesiIdo.split(':')[1]*1)}} perc</td>
                    <td class="p-3">{{r.Nehezseg}}</td>
                    <td class="p-3">{{r.BegyujthetoPontok}}</td>
                    <td class="p-3">{{r.Adag}}</td>
                    <td class="p-3 break-words max-w-[200px]">
                        {{r.Elkeszitesi_leiras | limitTo: 50}}
                        <span ng-if="r.Leiras.length > 50">...</span>
                    </td>
                    <td class="p-3">{{r.ElkeszitesiMod}}</td>
                    <td class="p-3">{{r.Arkategoria}}</td>
                    <td class="p-3">{{r.Alkategoria}}</td>
                    <td class="p-3">{{r.Kaloria}}</td>

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

    <div class="md:hidden space-y-4">

        <div class="bg-white m-2 rounded-lg shadow p-4"
            ng-repeat="r in recept track by r.id">

            <p class="text-lg font-semibold">
                {{r.Nev}}
            </p>

            <p class="text-sm text-gray-500">
                ID: {{r.id}}
            </p>

            <p class="text-sm">
                Idő: {{(r.ElkeszitesiIdo.split(':')[0]*60 + r.ElkeszitesiIdo.split(':')[1]*1)}} perc
            </p>

            <p class="text-sm">
                Nehézség: {{r.Nehezseg}}
            </p>

            <div class="flex gap-2 mt-3">

                <a href="receptek_szerkeszt.php?id={{r.id}}"
                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                    Szerkeszt
                </a>

                <a href="receptek_torol.php?id={{r.id}}"
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
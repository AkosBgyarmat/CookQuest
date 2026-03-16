<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<main class="flex-1 p-10" ng-controller="receptController">

    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Receptek - {{recept.length}}</h1>
    </header>

    <a href="receptekUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block">
        + Új recept
    </a>

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
                <td class="p-3">
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
<?php include "../layout/footer.php"; ?>
</main>


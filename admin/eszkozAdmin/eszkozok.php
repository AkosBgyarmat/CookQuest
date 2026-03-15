<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<main class="flex-1 p-10">
    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Eszközök</h1>
    </header>

    <a href="eszkozokUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block">
        + Új eszköz
    </a>

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

        <tbody ng-controller="eszkozController">

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

    <?php include "../layout/footer.php"; ?>
</main>
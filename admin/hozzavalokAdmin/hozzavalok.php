<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<main class="flex-1 p-10" ng-controller="hozzavaloController">

    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Hozzávalók - {{hozzavalo.length}}</h1>
    </header>

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
                <td class="p-3">{{h.ELnevezes}}</td>
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
            
<?php include "../layout/footer.php"; ?>
</main>
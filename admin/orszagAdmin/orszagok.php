<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<main class="flex-1 p-10" ng-controller="orszagController">

    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Országok - {{orszagok.length}}</h1>
    </header>

    <a href="orszagokUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block">
        + Új ország
    </a>

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
<?php include "../layout/footer.php"; ?>
</main>


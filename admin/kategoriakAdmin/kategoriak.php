<?php include "../layout/header.php"; ?>

<main class="flex-1 md:p-2 md:pt-10" ng-controller="kategoriaController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Kategóriák - {{eszkozKategoria.length + receptKategoria.length}}</h1>
    </header>

    <div>

        <header class="flex items-center justify-between m-2 ">
            <h3 class="text-xl font-bold">
                Eszköz kategóriák - {{eszkozKategoria.length}}
            </h3>
        </header>

        <a href="receptekUj.php"
            class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block m-2">
            + Új eszköz kategória
        </a>

        <div class="hidden md:block overflow-x-auto">

            <table class="w-full table-fixed bg-white shadow rounded">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left w-16">ID</th>
                        <th class="p-3 text-left">Elnevezés</th>
                        <th class="p-3 text-left w-40">Műveletek</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-t hover:bg-gray-50"
                        ng-repeat="b in eszkozKategoria track by b.id">

                        <td class="p-3">{{b.id}}</td>

                        <td class="p-3 truncate max-w-[300px]">
                            {{b.ELnevezes}}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                    Szerkeszt
                                </a>

                                <a class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                    Törlés
                                </a>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="md:hidden space-y-3">

            <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
                ng-repeat="b in eszkozKategoria track by b.id">

                <div>

                    <p class="text-sm text-gray-500">
                        ID: {{b.id}}
                    </p>

                    <p class="font-semibold">
                        {{b.ELnevezes}}
                    </p>

                </div>

                <div class="flex gap-2">

                    <a class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                        Szerkeszt
                    </a>

                    <a class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                        Törlés
                    </a>

                </div>

            </div>

        </div>

    </div>

    <div>

        <header class="flex items-center justify-between m-2 mt-10">
            <h3 class="text-xl font-bold">
                Recept kategóriák - {{receptKategoria.length}}
            </h3>
        </header>

        <a href="receptekUj.php"
            class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block ml-2">
            + Új recept kategória
        </a>

        <div class="hidden md:block overflow-x-auto">

            <table class="w-full table-fixed bg-white shadow rounded">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left w-16">ID</th>
                        <th class="p-3 text-left">Kategória</th>
                        <th class="p-3 text-left w-40">Műveletek</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-t hover:bg-gray-50"
                        ng-repeat="k in receptKategoria track by k.id">

                        <td class="p-3">{{k.id}}</td>

                        <td class="p-3 truncate max-w-[300px]">
                            {{k.Kategoria}}
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                    Szerkeszt
                                </a>

                                <a class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                    Törlés
                                </a>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="md:hidden space-y-3">

            <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
                ng-repeat="k in receptKategoria track by k.id">

                <div>

                    <p class="text-sm text-gray-500">
                        ID: {{k.id}}
                    </p>

                    <p class="font-semibold">
                        {{k.Kategoria}}
                    </p>

                </div>

                <div class="flex gap-2">

                    <a class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                        Szerkeszt
                    </a>

                    <a class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                        Törlés
                    </a>

                </div>

            </div>

        </div>

    </div>
</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>